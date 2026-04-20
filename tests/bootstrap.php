<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;
use Zenstruck\Foundry\Test\UnitTestConfig;
use Zenstruck\Foundry\Object\Instantiator;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}


UnitTestConfig::configure(
    instantiator: Instantiator::withoutConstructor()->alwaysForce(),
    faker: Faker\Factory::create('en_GB')
);
