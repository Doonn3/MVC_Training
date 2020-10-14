<?php

namespace Core;

use Core\View;

abstract class Controller {
    private $route;
    protected $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
}