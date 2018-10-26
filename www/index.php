<?php

require_once './init.php';
require_once './../config/config.php';

use App\Routing\Router;

define('ROOT', dirname(__FILE__));

session_start();

$router = new Router();
$router->run();