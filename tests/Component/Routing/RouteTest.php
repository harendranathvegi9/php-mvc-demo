<?php

namespace Mvc\Tests\Component\Routing;

use Mvc\Component\Http\Request;
use Mvc\Component\Routing\Route;
use Mvc\Tests\TestCase;

class RouteTest extends TestCase
{
    public function testConstructor()
    {
        $route = new Route('get', '/path', 'Mvc\\Controller\\IndexController:indexAction');

        $this->assertAttributeEquals(Request::METHOD_GET, 'method', $route);
        $this->assertAttributeEquals('/path', 'path', $route);
        $this->assertAttributeInternalType('array', 'handler', $route);
        $this->assertAttributeInternalType('callable', 'handler', $route);
    }

    public function testMatch()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/path';

        $request = new Request();
        $route = new Route('get', '/path', 'Mvc\\Controller\\IndexController:indexAction');

        $this->assertTrue($route->match($request));

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/path';

        $request = new Request();
        $route = new Route('get', '/path', 'Mvc\\Controller\\IndexController:indexAction');

        $this->assertFalse($route->match($request));

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/path/to';

        $request = new Request();
        $route = new Route('get', '/path', 'Mvc\\Controller\\IndexController:indexAction');

        $this->assertFalse($route->match($request));
    }

    public function testGetRequestHandler()
    {
        $route = new Route('get', '/path', 'Mvc\\Controller\\IndexController:indexAction');

        $this->assertInternalType('array', $route->getRequestHandler());
        $this->assertInternalType('callable', $route->getRequestHandler());
    }
}