<?php

namespace Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler;

use Gerfey\GrandoEspadaDiscord\Components\Command\CommandSubscriber;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterCommandSubscribersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $commandSubscriber = $container->get(CommandSubscriber::class);

        foreach ($commandSubscriber::getSubscribedServices() as $key => $subscribedService) {
            $container->register($key, $subscribedService)->setPublic(true);
        }
    }
}