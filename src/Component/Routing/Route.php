<?php

namespace Mvc\Component\Routing;

use Mvc\Component\Http\Request;

class Route
{
    /** @var string */
    protected $method = Request::METHOD_GET;
    /** @var string */
    protected $path = '/';
    /** @var string */
    protected $handler;

    public function __construct($method, $path, $handler)
    {
        $this->method = strtoupper($method);
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function match(Request $request)
    {
        return $this->method === $request->getMethod() &&
                    preg_match('/^' . preg_quote($this->path, '/') . '$/i', $request->getPath());
    }

    /**
     * @param Request $request
     * @return callable
     */
    public function getRequestHandler(Request $request)
    {
        $request->setAttribute('route', $this->handler);
        return $this->parseHandler($request);
    }

    /**
     * @param Request $request
     * @return callable
     */
    private function parseHandler(Request $request)
    {
        list($controllerClass, $method) = explode(':', $this->handler, 2);
        return [new $controllerClass($request), $method];
    }
}