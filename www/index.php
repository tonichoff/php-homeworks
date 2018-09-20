<?php

require_once './init.php';
require_once './../config/config.php';

use App\Routing\Router;

#spl_autoload_register(function($class) {
#    $path = str_replace('\\', '/', $class.'.php');
#    echo "<br>Path: $path</br>";
#    if (file_exists($path)) {
#        require $path;
#    }
#});

define('ROOT', dirname(__FILE__));

session_start();

$router = new Router();
$router->run();
