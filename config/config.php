<?php

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$definition = new Definition();
$definition->setAutoconfigured(true);
$definition->setPublic(false);

/** @var PhpFileLoader $loader */
$loader->registerClasses($definition, 'Gerfey\\GrandoEspadaDiscord\\', '../src/*', '../src/{Entity, Repository, DependencyInjection}');