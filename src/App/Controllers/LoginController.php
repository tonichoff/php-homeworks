<?php

namespace App\Controllers;

use App\DataBase\DataBase;

class LoginController extends Controller
{
    public function actionLogin($parameters)
    {
        $this->_view->render('Вход');
        $db = new DataBase();
    }
}