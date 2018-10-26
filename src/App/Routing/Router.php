<?php

namespace App\Routing;
use App\Controllers;
use App\Views\View;

class Router
{
    private $_routes;
    private $_params;

    public function __construct()
    {
        $routes_path = ROOT . '/../config/routes.php';
        $routes = require $routes_path;
        foreach ($routes as $route => $params) {
            $this->_routes[$route] = $params;
        }
    }

    public function run()
    {
        if ($this->match()) {
            $controller_name = "\App\Controllers\\" . ucfirst($this->_params['controller']) . 'Controller';
            if (class_exists($controller_name)) {
                $action = 'action' . ucfirst($this->_params['action']);
                $controller = new $controller_name($this->_params);

                $args =  explode('/', $this->getURI());
                array_shift($args);

                $controller->$action($args);
            }
            else {
                View::errorCode(500, "I didn't find controller");
            }
        }
        else {
            View::errorCode(404);
        }
    }

    private function match()
    {
        $uri = $this->getURI();
        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route => $params) {
            if (preg_match('#^' . $route . '$#', $uri)) {
                $this->_params = $params;
                return true;
            }
        }
        return false;
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        else {
            View::errorCode(404);
        }
    }
}