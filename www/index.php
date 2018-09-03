<?php

require_once './init.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
$router_path = ROOT.'/../src/App/Routing/Router.php';

if (file_exists($router_path)) {
    require_once($router_path);
    $router = new Router();
    $router->run();
}
else {
    echo "<p>Router not included</p>";
    echo "<p>path: $router_path</p>";
}