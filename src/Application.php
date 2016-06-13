<?php

namespace Mvc;

use Mvc\Component\Http\Request;
use Mvc\Component\Http\Response;
use Mvc\Component\Routing\Router;

class Application
{
    protected $config;
    protected $router;

    public function __construct(Router $router, $config)
    {
        $this->router = $router;
        $this->config = $config;
    }

    public function run()
    {
        $request = Request::createFromGlobals();
        $response = $this->handle($request);
        $response->send();
    }

    /**
     * @param Request $request
     * @return Response
     */
    protected function handle(Request $request)
    {
        $controller = $this->router->handle($request);
        $response = call_user_func($controller, $request);
        return $response;
    }
}