<?php

namespace Mvc\Tests\Component\Http;

use Mvc\Component\Http\Request;
use Mvc\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testDefaultConstructor()
    {
        $request = new Request();

        $this->assertEquals($_GET, $request->query);
        $this->assertEquals($_POST, $request->post);
        $this->assertEquals($_COOKIE, $request->cookies);
        $this->assertEquals($_FILES, $request->files);
        $this->assertEquals($_SERVER, $request->server);
        $this->assertEquals(null, $request->content);
    }

    public function testConstructor()
    {
        $query = [
            'foo' => 'bar',
            'test' => 1,
        ];

        $request = new Request($query);

        $this->assertArrayHasKey('foo', $request->query);
        $this->assertArrayHasKey('test', $request->query);
        $this->assertEquals('bar', $request->query['foo']);
        $this->assertEquals(1, $request->query['test']);
    }

    public function testGetMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $request = new Request();

        $this->assertArrayHasKey('REQUEST_METHOD', $request->server);
        $this->assertEquals('POST', $request->server['REQUEST_METHOD']);
        $this->assertEquals('post', $request->getMethod());
    }

    public function testGetPath()
    {
        $_SERVER['REQUEST_URI'] = '/base-dir/page.php?q=bogus&n=10';

        $request = new Request();

        $this->assertArrayHasKey('REQUEST_URI', $request->server);
        $this->assertEquals('/base-dir/page.php?q=bogus&n=10', $request->server['REQUEST_URI']);
        $this->assertEquals('/base-dir/page.php', $request->getPath());
    }
}