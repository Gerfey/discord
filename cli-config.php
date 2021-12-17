<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . "/config/bootstrap.php";

/**@var EntityManager $entityManager */
return ConsoleRunner::createHelperSet($entityManager);