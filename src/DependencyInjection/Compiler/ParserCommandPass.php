<?php

namespace Gerfey\GrandoEspadaDiscord\DependencyInjection\Compiler;

use Gerfey\GrandoEspadaDiscord\Components\Command\ParserCommand;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ParserCommandPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->getDefinition(ParserCommand::class);
        $accessManagerDefinition->setPublic(true);
    }
}