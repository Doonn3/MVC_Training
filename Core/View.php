<?php

namespace Core;

class View {
    private $route;
    private $routePath;
    private $defaultLayout = 'defaultLayout';

    public function __construct($route)
    {
        $this->route = $route;
        $this->routePath = $route['controller'] . '/' . $route['action'] . '.html';
    }

    public function render ($vars = []) {
        extract($vars);

        $path = 'src\view\\' . $this->routePath;

        ob_start();
        require_once $path;
        $content = ob_get_clean();
        require_once 'src\view\\' . $this->defaultLayout . '\\' . $this->defaultLayout . '.html';
    }

    static function errorCode($error) {
        require_once 'src\view\errors\\' . $error . '.html';
    }
}