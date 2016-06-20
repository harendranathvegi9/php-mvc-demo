<?php

namespace Mvc\Component;

class View
{
    /** @var string */
    protected $controller;
    /** @var string */
    protected $layout;

    public function __construct($controller, $layout)
    {
        $this->controller = $controller;
        $this->layout = $layout;
    }

    public function render($template, $params = [])
    {
        $render = function($template) use ($params) {
            ob_start();

            extract($params);
            require sprintf('%s/%s/%s.phtml', VIEW_PATH, strtolower($this->controller), $template);

            return ob_get_clean();
        };
        $templateContent = $render($template);

        ob_start();

        extract(['content' => $templateContent]);
        require sprintf('%s/layout/%s.phtml', VIEW_PATH, $this->layout);

        return ob_get_clean();
    }
}