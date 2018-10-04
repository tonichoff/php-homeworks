<?php

namespace App\Views;

class View {

    private $_path;
    private $_route;
    private $_layout = 'default';

    public function __construct($route)
    {
        $this->_route = $route;
        $this->_path = ucfirst($route['controller']) . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        $layout_path = ROOT . '/../src/App/Views/Layouts/' . $this->_layout . '.php';
        if (file_exists($layout_path)) {
            $view_path = ROOT. '/../src/App/Views/' . $this->_path . '.php';
            if (file_exists($view_path)) {
                require $view_path;
                ob_start();
                $content = ob_get_clean();
                require $layout_path;
            }
            else {
                View::errorCode(500);
            }

        }
        else {
            View::errorCode(500);
        }
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path = ROOT . '/../src/App/Views/Errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        else {
            if ($code != 500) {
                View::errorCode(500);
            }
            else {
                echo "We can't found page with error code 500. So, let's think that it's 500 error code page";
            }
        }
    }
}