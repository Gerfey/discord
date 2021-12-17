<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (!class_exists(Dotenv::class)) {
    throw new LogicException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
}

if (is_array($env = @include dirname(__DIR__) . '/.env.local') && (!isset($env['APP_ENV']) || ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? $env['APP_ENV']) === $env['APP_ENV'])) {
    (new Dotenv(false))->populate($env);
} else {
    (new Dotenv(false))->loadEnv(dirname(__DIR__) . '/.env');
}

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "../../src"), true, null, null, false);

// database configuration parameters
$conn = array(
    'driver' => $_ENV['DB_DRIVER'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);