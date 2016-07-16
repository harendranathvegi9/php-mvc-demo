<?php

namespace Mvc\Tests\Component\Routing;

use Mvc\Component\Routing\Route;
use Mvc\Tests\TestCase;

class RouteTest extends TestCase
{
    public function testConstructor()
    {
        $route = new Route('get', '/', 'IndexController:indexAction');
    }
}