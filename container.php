<?php

$GLOBALS['container'] = new \Slim\Container;
function container()
{
	return $GLOBALS['container'];
}

container()['settings'] = require_once(__DIR__ . '/settings.php');

require __DIR__ . '/bootstrap/index.php';
require __DIR__ . '/api/index.php';

return container();