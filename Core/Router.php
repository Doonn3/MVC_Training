<?php

namespace Core;

class Router
{

    private $routes = [];
    private $params = [];

    function __construct()
    {
        $arr = require_once 'Config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }


    public function add($router, $param)
    {
        $this->routes[$router] = $param;
    }

    public function similarity()
    {
        $url = trim($_SERVER["REQUEST_URI"], '/');
        $urlExplode = explode('/', $url);
        $urlModify = trim(str_replace($urlExplode[0], '', $url), '/');

        foreach ($this->routes as $key => $value) {
            if ($key == $urlModify) {
                $this->params = $value;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->similarity()) {
            $pathController = 'src\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

            if (class_exists($pathController)) {
                $action = $this->params['action'] . 'Action';

                if (method_exists($pathController, $action)) {
                    $controller = new $pathController($this->params);
                    $controller->$action();
                 } else {
                    View::errorCode(402);
                    echo 'ТАКОЙ ACTION НЕ НАЙДЕН: ' . $action;
                }
            } else {
                View::errorCode(403);
                echo 'ТАКОЙ КОНТРОЛЛЕР НЕ НАЙДЕН: ' . $pathController;
            }
        } else {
            View::errorCode(404);
            echo 'ТАКОЙ МАРШРУТ НЕ НАЙДЕН: ' . trim($_SERVER["REQUEST_URI"], '/');
        }
    }
}
