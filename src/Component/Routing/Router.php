<?php

namespace Mvc\Component\Routing;

use Mvc\Component\Exception\RouteNotFoundException;
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
     * @param Route[] $routes
     */
    public function addRoutes($routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * @param Request $request
     * @return callable
     * @throws RouteNotFoundException
     */
    public function handle(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getRequestHandler();
            }
        }
        throw new RouteNotFoundException('Route does not exists');
    }
}