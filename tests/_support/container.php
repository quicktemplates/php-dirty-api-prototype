<?php

$container = new \Slim\Container;

$GLOBALS['oontainer'] = $container;
function container()
{
	return $GLOBALS['container'];
}

$container['settings'] = require_once(__DIR__ . '/../../settings.php');

require __DIR__ . '/../../bootstrap/app.php';

return $container;