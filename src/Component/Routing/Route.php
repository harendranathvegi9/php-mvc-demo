<?php

namespace Mvc\Component\Routing;

use Mvc\Component\Http\Request;

class Route
{
    protected $method = 'get';
    protected $path = '';
    /** @var callable */
    protected $handler;

    public function __construct($method, $path, $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $this->parseHandler($handler);
    }

    public function match(Request $request)
    {
        return $this->method === $request->getMethod() && $this->path === $request->getPath();
    }

    public function getRequestHandler()
    {
        return $this->handler;
    }

    private function parseHandler($handler)
    {
        list($controllerClass, $method) = explode('::', $handler);
        return [new $controllerClass, $method . 'Action'];
    }
}