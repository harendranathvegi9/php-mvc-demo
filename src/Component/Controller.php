<?php

namespace Mvc\Component;

class Controller
{
    /** @var View */
    public $view;
    /** @var string */
    public $layout;
    
    public function __construct()
    {
        $this->view = new View(static::class, $this->layout);
    }
}