<?php

namespace App\Controllers;

class LoginController extends Controller
{
    public function actionLogin($parameters)
    {
        $this->_view->render('Вход');
    }
}