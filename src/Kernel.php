<?php

namespace Gerfey\GrandoEspadaDiscord;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler\CommandSubscriberPass;
use Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler\DiscordRegisterPass;
use Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler\GrandoEspadaDiscordPass;
use Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler\ParserCommandPass;
use Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler\RegisterCommandSubscribersPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class Kernel
{
    protected ContainerBuilder $containerBuilder;

    private PhpFileLoader $fileLoader;

    private string $configPath = __DIR__ . '/../config';

    public function __construct()
    {
        $this->containerBuilder = new ContainerBuilder();
        $this->fileLoader = new PhpFileLoader($this->containerBuilder, new FileLocator($this->configPath));
        $this->fileLoader->load('config.php');

        $this->addListCompilerPass();
    }

    public function handle(): void
    {
        $geDiscord = $this->containerBuilder->get(GrandoEspadaDiscord::class);

        $discord = $this->containerBuilder->get('discord.bot');

        $discord->on('ready', function (Discord $discord) use ($geDiscord) {
            echo "Bot is ready!", PHP_EOL;

            $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use ($geDiscord) {

                $geDiscord->setMessage($message);
                $geDiscord->setDiscord($discord);
                $geDiscord->handle();

                echo "{$message->author->username}: {$message->content}", PHP_EOL;
            });
        });

        $discord->run();
    }

    private function addListCompilerPass(): void
    {
        $this->containerBuilder->addCompilerPass(new CommandSubscriberPass());
        $this->containerBuilder->addCompilerPass(new DiscordRegisterPass());
        $this->containerBuilder->addCompilerPass(new ParserCommandPass());
        $this->containerBuilder->addCompilerPass(new GrandoEspadaDiscordPass());
        $this->containerBuilder->addCompilerPass(new RegisterCommandSubscribersPass());

        $this->containerBuilder->compile();
    }
}