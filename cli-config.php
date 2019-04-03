<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Slim\Container;

require_once __DIR__ . '/container.php';

$connection = $container[EntityManager::class]->getConnection();

$helperSet = new HelperSet([
	'db' => new ConnectionHelper($connection),
	'question' => new QuestionHelper(),
	'em' => new EntityManagerHelper($container[EntityManager::class]),
]);

ConsoleRunner::run(
    $helperSet,
    [
    	new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\UpToDateCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
	    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
    ]
);