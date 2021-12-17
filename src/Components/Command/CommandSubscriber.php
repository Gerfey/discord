<?php

namespace Gerfey\GrandoEspadaDiscord\Components\Command;

use Gerfey\GrandoEspadaDiscord\Components\Command\Variable\CreateEmbedCommand;
use Gerfey\GrandoEspadaDiscord\Components\Command\Variable\TestCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class CommandSubscriber implements ServiceSubscriberInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedServices(): array
    {
        return [
            'embed' => CreateEmbedCommand::class,
            'test' => TestCommand::class,
        ];
    }

    public function getCommand(string $command): ?CommandInterface
    {
        if ($this->container->has($command)) {
            return $this->container->get($command);
        }

        return null;
    }
}