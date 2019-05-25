<?php

define('APP_ROOT', __DIR__);

$devMode = getenv('ENV') !== 'produciton';

return [
	'displayErrorDetails' => $devMode,
	'determineRouteBeforeAppMiddleware' => true,
	'outputBuffering' => $devMode ? 'prepend' : false,
	'httpVersion' => '1.1',

	'doctrine' => [
		'dev_mode' => $devMode,
		'cache_dir' => APP_ROOT . '/cache/doctrine',
		'metadata_dirs' => [APP_ROOT . '/domain'],
		'connection' => [
			'driver' => 'pdo_mysql',
			'dbname' => getenv('DB_NAME') ?: 'api_prototype',
			'host' => getenv('DB_HOST') ?: 'localhost',
			'port' => getenv('DB_PORT') ?: 3306,
			'user' => getenv('DB_USER') ?: 'root',
			'password' => getenv('DB_PASS') ?: 'root',
			'charset' => 'utf8'
		]
	]
];
