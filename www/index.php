<?php

//phpinfo();

define('ROOT', dirname(__FILE__));

require_once './init.php';
require_once './../config/config.php';

use App\Routing\Router;
use App\Authentication\Service\AuthenticationService;

$auth_service = new AuthenticationService();
$credentials = '';
if (isset($_COOKIE['auth_cookie'])) {
    $credentials = ($_COOKIE['auth_cookie']);
}
$user_token = $auth_service->authenticate($credentials);
if (!$user_token->isAnonymous()) {
    $_SESSION['user'] = $user_token->getUser();
}

$router = new Router();
$router->run();