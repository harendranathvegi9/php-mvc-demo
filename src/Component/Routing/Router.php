<?php

namespace Mvc\Component\Routing;

use Mvc\Component\Http\Request;

class Router
{
    /** @var Route[] */
    protected $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param Request $request
     * @return callable
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getRequestHandler();
            }
        }
        throw new \Exception('');
    }
}