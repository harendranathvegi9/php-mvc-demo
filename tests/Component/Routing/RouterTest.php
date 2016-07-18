<?php

namespace Mvc\Tests\Component\Routing;

use Mvc\Component\Http\Request;
use Mvc\Component\Routing\Route;
use Mvc\Component\Routing\Router;
use Mvc\Tests\TestCase;

class RouterTest extends TestCase
{
    public function testConstructor()
    {
        $router = new Router();

        $this->assertAttributeInternalType('array', 'routes', $router);
        $this->assertAttributeEmpty('routes', $router);
    }

    public function testAddRoute()
    {
        $router = new Router();
        $router->addRoute(new Route('GET', '/', 'Mvc\\Controller\\AppController:indexAction'));

        $this->assertAttributeNotEmpty('routes', $router);
        $this->assertAttributeCount(1, 'routes', $router);
    }

    public function testAddRoutes()
    {
        $router = new Router();
        $router->addRoutes([
            new Route('GET', '/', 'Mvc\\Controller\\AppController:indexAction'),
            new Route('GET', '/profile', 'Mvc\\Controller\\AppController:profileAction'),
            new Route('PUT', '/profile', 'Mvc\\Controller\\AppController:profileUpdateAction'),
        ]);

        $this->assertAttributeNotEmpty('routes', $router);
        $this->assertAttributeCount(3, 'routes', $router);
    }

    public function testHandle()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/path';

        $request = new Request();

        $router = new Router();
        $router->addRoute(new Route('GET', '/path', 'Mvc\\Controller\\AppController:indexAction'));

        $this->assertInternalType('array', $router->handle($request));
        $this->assertInternalType('callable', $router->handle($request));
    }

    /**
     * @expectedException \Mvc\Component\Exception\RouteNotFoundException
     */
    public function testHandlerNotFound()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/path';

        $request = new Request();
        $router = new Router();
        $router->handle($request);
    }
}