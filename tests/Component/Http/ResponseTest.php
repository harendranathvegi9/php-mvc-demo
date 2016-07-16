<?php

namespace Mvc\Tests\Component\Http;

use Mvc\Component\Http\Response;
use Mvc\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testDefaultConstructor()
    {
        $response = new Response();
        
        $this->assertEquals('', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testConstructor()
    {
        $response = new Response('foo', 401);

        $this->assertEquals('foo', $response->getContent());
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testSetContent()
    {
        $response = new Response();
        $response->setContent('bar');

        $this->assertEquals('bar', $response->getContent());
    }

    public function testSetStatusCode()
    {
        $response = new Response();
        $response->setStatusCode('301');

        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testSend()
    {
        $response = new Response('test', 301);

        ob_start();

        $response->send();
        $content = ob_get_clean();

        $this->assertEquals('test', $content);
        $this->assertEquals(301, http_response_code());
    }
}