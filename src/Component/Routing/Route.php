<?php

namespace Mvc\Component\Routing;

use Mvc\Component\Http\Request;

class Route
{
    /** @var string */
    protected $method = 'get';
    /** @var string */
    protected $path = '/';
    /** @var callable */
    protected $handler;

    public function __construct($method, $path, $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $this->parseHandler($handler);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function match(Request $request)
    {
        return $this->method === $request->getMethod() &&
                    preg_match("/^" . preg_quote($this->path) . "$/i", $request->getPath());
    }

    /**
     * @return callable
     */
    public function getRequestHandler()
    {
        return $this->handler;
    }

    /**
     * @param string $handler
     * @return callable
     */
    private function parseHandler($handler)
    {
        list($controllerClass, $method) = explode('::', $handler);
        return [new $controllerClass, $method . 'Action'];
    }
}