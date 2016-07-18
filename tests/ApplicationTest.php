<?php

namespace Mvc\Tests;

use Mvc\Application;
use Mvc\Component\Http\Request;
use Mvc\Component\Routing\Route;
use Mvc\Component\Routing\Router;

class ApplicationTest extends TestCase
{
    public function testConstructor()
    {
        $router = new Router();
        $app = new Application($router);

        $this->assertAttributeInstanceOf(Router::class, 'router', $app);
    }

    public function testRun()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';

        $router = new Router();
        $app = new Application($router);

        $router->addRoutes([
            new Route(
                Request::METHOD_GET, '/', 'Mvc\\Controller\\AppController:indexAction'
            )
        ]);

        ob_start();
        $app->run();
        $content = ob_get_clean();

        $this->assertEquals('<html><body><div>index</div></body></html>', $content);
    }
}