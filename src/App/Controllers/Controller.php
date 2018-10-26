<?php

namespace App\Controllers;
use App\Views\View;
use App\Models;

abstract class Controller
{
    protected $_route;
    protected $_view;
    protected $_model;

    public function __construct($route)
    {
        $this->_route = $route;
        $this->_view = new View($route);
        //$this->_model = $this->loadModel($this->_route['controller']);
    }

    public function loadModel($name)
    {
        $model_name = '\App\Models\\' . ucfirst($name);
        if (class_exists($model_name)) {
            return new $model_name();
        } else {
            View::errorCode(500, "I didn't find model");
        }
    }
}