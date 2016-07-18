<?php

namespace Mvc\Tests\Component;

use Mvc\Component\Http\Request;
use Mvc\Component\View;
use Mvc\Controller\AppController;
use Mvc\Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testConstructor()
    {
        $request = new Request();
        $request->setAttribute('route', 'Mvc\\Controller\\AppController:indexAction');
        $controller = new AppController($request);

        $this->assertAttributeInstanceOf(Request::class, 'request', $controller);
        $this->assertAttributeInstanceOf(View::class, 'view', $controller);

        $this->assertAttributeInternalType('string', 'route', $controller->view);
        $this->assertAttributeNotEmpty('route', $controller->view);

        $this->assertAttributeInternalType('string', 'layout', $controller->view);
        $this->assertAttributeNotEmpty('layout', $controller->view);
    }
}