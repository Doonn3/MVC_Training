<?php

function autoloader ($class) { 
    $path = $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

spl_autoload_register ('autoloader');