<?php

namespace Mvc;

use Mvc\Component\Http\Request;
use Mvc\Component\Http\Response;
use Mvc\Component\Routing\Router;

class Application
{
    /** @var Router */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $request = new Request();
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