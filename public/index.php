<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__ . '/..');
define('VIEW_PATH', __DIR__ . '/../resources/views');

require_once __DIR__ . '/../vendor/autoload.php';

$router = new \Mvc\Component\Routing\Router();
$app = new \Mvc\Application($router);

$router->addRoutes([
    new \Mvc\Component\Routing\Route(
        \Mvc\Component\Http\Request::METHOD_GET, '/', 'Mvc\\Controller\\AppController:indexAction'
    )
]);

$app->run();