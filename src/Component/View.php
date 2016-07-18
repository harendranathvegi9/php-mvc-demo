<?php

namespace Mvc\Component;

class View
{
    /** @var string */
    protected $route;
    /** @var string */
    protected $layout;

    public function __construct($route, $layout)
    {
        $this->route = $route;
        $this->layout = $layout;
    }

    public function render($template = null, $params = [])
    {
        if (!$template) {
            $template = strtolower(str_replace('Action', '', $this->getAction()));
        }
        $controller = $this->getController();
        $baseDir = strtolower(str_replace('Controller', '', $controller));

        $render = function($template) use ($baseDir, $params) {
            ob_start();

            extract($params);
            require sprintf('%s/%s/%s.phtml', VIEW_PATH, $baseDir, $template);

            return ob_get_clean();
        };
        $templateContent = $render($template);

        ob_start();

        extract(['content' => $templateContent]);
        require sprintf('%s/layout/%s.phtml', VIEW_PATH, $this->layout);

        return ob_get_clean();
    }

    protected function getController()
    {
        $routeParts = explode(':', $this->route, 2);
        $controllerClassWithNamespace = explode('\\', $routeParts[0]);

        return end($controllerClassWithNamespace);
    }

    protected function getAction()
    {
        $routeParts = explode(':', $this->route, 2);
        return $routeParts[1];
    }
}