<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;
use Psr\Container\ContainerInterface;

// Register Doctrine Entity Manager
container()[EntityManager::class] = function (ContainerInterface $container) : EntityManager {
	$config = Setup::createAnnotationMetadataConfiguration(
	    $container['settings']['doctrine']['metadata_dirs'],
	    $container['settings']['doctrine']['dev_mode']
	);

	$config->setMetadataDriverImpl(
	    new AnnotationDriver(
	        new AnnotationReader,
	        $container['settings']['doctrine']['metadata_dirs']
	    )
	);

	$config->setMetadataCacheImpl(
	    new FilesystemCache(
	        $container['settings']['doctrine']['cache_dir']
	    )
	);

	$entityManager = EntityManager::create(
	    $container['settings']['doctrine']['connection'],
	    $config
	);

	return $entityManager;
};

function em() {
	return container()[EntityManager::class];
}
