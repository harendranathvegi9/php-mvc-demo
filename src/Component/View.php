<?php

namespace Mvc\Component;

class View
{
    protected $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    public function render($template, $params = [])
    {
        ob_start();

        extract($params);

        $content = ob_get_contents();

        ob_end_flush();

        return $content;
    }
}