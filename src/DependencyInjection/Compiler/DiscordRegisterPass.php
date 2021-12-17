<?php

namespace Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler;

use Discord\Discord;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DiscordRegisterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->register('discord.bot', Discord::class);
        $accessManagerDefinition->setPublic(true);
        $accessManagerDefinition->addArgument(
            [
                'token' => $_ENV['DISCORD_TOKEN'],
            ]
        );
    }
}