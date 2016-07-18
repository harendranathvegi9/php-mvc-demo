<?php

namespace Mvc\Component;

use Mvc\Component\Http\Request;

abstract class Controller
{
    /** @var Request */
    public $request;
    /** @var View */
    public $view;
    /** @var string */
    protected $layout;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View($request->getAttribute('route'), $this->layout);
    }
}