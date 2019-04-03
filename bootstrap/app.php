<?php

use Psr\Container\ContainerInterface;
use Slim\App;

container()[App::class] = function (ContainerInterface $container) {
	return new App($container);
};

function app()
{
	return container()[App::class];
}