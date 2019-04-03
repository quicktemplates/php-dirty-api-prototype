<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

require __DIR__ . '/../container.php';

$container[\Slim\App::class]->run();
