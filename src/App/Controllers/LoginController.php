<?php

namespace App\Controllers;

use App\DataBaseConnection\DataBaseConnection;

class LoginController extends Controller
{
    public function actionLogin($parameters)
    {
        $this->_view->render('Вход');
        $db = new DataBaseConnection();
    }
}