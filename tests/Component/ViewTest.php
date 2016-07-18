<?php

namespace Mvc\Tests\Component;

use Mvc\Component\View;
use Mvc\Tests\TestCase;

class ViewTest extends TestCase
{
    public function testConstructor()
    {
        $view = new View('Mvc\\Controller\\AppController:indexAction', 'main');

        $this->assertAttributeInternalType('string', 'route', $view);
        $this->assertAttributeNotEmpty('route', $view);

        $this->assertAttributeInternalType('string', 'layout', $view);
        $this->assertAttributeNotEmpty('layout', $view);
    }

    public function testRender()
    {
        $view = new View('Mvc\\Controller\\AppController:indexAction', 'main');
        $content = $view->render();

        $this->assertEquals('<html><body><div>index</div></body></html>', $content);
    }
}