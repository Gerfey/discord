<?php

namespace Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler;

use Gerfey\GrandoEspadaDiscord\Components\Command\CommandSubscriber;
use Gerfey\GrandoEspadaDiscord\Components\Command\ParserCommand;
use Gerfey\GrandoEspadaDiscord\GrandoEspadaDiscord;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class GrandoEspadaDiscordPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->getDefinition(GrandoEspadaDiscord::class);
        $accessManagerDefinition->setPublic(true);
        $accessManagerDefinition->addArgument(new Reference(CommandSubscriber::class));
        $accessManagerDefinition->addArgument(new Reference(ParserCommand::class));
    }
}