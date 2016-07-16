<?php

namespace Mvc\Component;

abstract class Controller
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