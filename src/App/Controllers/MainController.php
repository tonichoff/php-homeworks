<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function actionIndex($parameters)
    {
        $this->_view->render('Главная страница');

    }
}