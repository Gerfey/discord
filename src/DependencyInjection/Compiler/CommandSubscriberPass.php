<?php

namespace Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler;

use Gerfey\GrandoEspadaDiscord\Components\Command\CommandSubscriber;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CommandSubscriberPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->getDefinition(CommandSubscriber::class);
        $accessManagerDefinition->setPublic(true);
        $accessManagerDefinition->addArgument(new Reference('service_container'));
    }
}