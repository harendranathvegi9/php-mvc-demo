<?php

namespace Mvc;

use Mvc\Component\Http\Request;
use Mvc\Component\Http\Response;

class Application
{
    protected $config;

    public function __construct($config)
    {
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
        return new Response();
    }
}