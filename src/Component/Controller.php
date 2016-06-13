<?php

namespace Mvc\Component;

class Controller
{
    public $config;
    public $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
}