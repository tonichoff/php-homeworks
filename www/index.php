<?php

//phpinfo();

require_once './init.php';
require_once './../config/config.php';

use App\Routing\Router;
use App\Authentication\Service\AuthenticationService;

define('ROOT', dirname(__FILE__));

session_start();

//$auth_service = new AuthenticationService();
//$credentials = (isset($_COOKIE['auth_cookie']));
//$user_token = $auth_service->authenticate($credentials);
//if ($user_token->isAnonymous()) {
//    echo 'Вы Аноним';
//}
//else {
//    echo 'Вы не Аноним';
//}

$router = new Router();
$router->run();