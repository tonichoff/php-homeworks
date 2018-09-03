<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 03.09.18
 * Time: 18:41
 */

class Router
{
    private $_routes;

    public function __construct()
    {
        $routes_path = ROOT . '/../config/routes.php';
        if (file_exists($routes_path)) {
            $this->_routes = include($routes_path);
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->_routes as $uri_pattern => $path) {
            if (preg_match("~$uri_pattern~", $uri)) {
                $segments = explode('/', $path);
                $controller_name = ucfirst($segments[0] . 'Controller');
                $action_name = 'action' . ucfirst($segments[1]);

                $controller_path = ROOT . '/../src/App/Controllers/' . $controller_name . '.php';
                if (file_exists($controller_path)) {
                        include_once($controller_path);
                        $controller_object = new $controller_name;
                        $controller_object->$action_name();
                }
                else {
                    echo "<p>Controller not include</p>";
                    echo "<p>path: $controller_path</p>";
                }
            }
        }
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
}