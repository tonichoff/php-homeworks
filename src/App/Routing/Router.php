<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 03.09.18
 * Time: 18:41
 */

namespace App\Routing;

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
            $controller_name = ucfirst($this->_params['controller']) . 'Controller';
            $controller_path = ROOT . '/../src/App/Controllers/' . $controller_name . '.php';
            if (file_exists($controller_path)) {
                require_once $controller_path;
                $action = 'action' . ucfirst($this->_params['action']);
                $controller = new $controller_name();

                $args =  explode('/', $this->getURI());
                array_shift($args);

                $controller->$action($args);
            }
        }
        else {
            echo "<br>404</br>";
        }
    }

    private function match()
    {
        $uri = $this->getURI();
        foreach ($this->_routes as $route => $params) {
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
    }
}