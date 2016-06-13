<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/config.php';

$router = new \Mvc\Component\Routing\Router();
$app = new \Mvc\Application($router, $config);

$router->addRoute(
    new \Mvc\Component\Routing\Route('get', '/', 'Mvc\Component\Controller::index')
);

$app->run();