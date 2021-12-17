<?php

require dirname(__DIR__) . '/config/bootstrap.php';

use Gerfey\GrandoEspadaDiscord\Kernel;

$kernel = new Kernel();
$kernel->handle();