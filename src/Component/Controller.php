<?php

namespace Mvc\Component;

use Mvc\Component\Http\Request;
use Mvc\Component\Http\Response;

class Controller
{
    public $config;
    public $view;
    public $layout;
    
    public function __construct()
    {
        $this->view = new View($this->layout);
    }

    public function indexAction(Request $request)
    {
        $content = $this->view->render('index');
        return new Response(200, $content);
    }
}