<?php

namespace src\Controllers;

use Core\Controller;

class MainController extends Controller{
    public function indexAction () {
       $this->view->render();
    }
}