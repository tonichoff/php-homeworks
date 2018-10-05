<?php

namespace App\Controllers;

class RegisterController extends Controller
{
    public function actionRegister($params)
    {
        $this->_view->render('Регистрация');
    }
}