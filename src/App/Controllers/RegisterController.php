<?php

namespace App\Controllers;

use App\DataBase\DataBase;

class RegisterController extends Controller
{
    public function actionShow($params)
    {
        $db = new DataBase();
        $action = 'find';
        $values = [
            'id' => 1,
            'login' => 'admin'
        ];
        $tabel = 'Users';
        $db->query($action, $tabel, $values);
        $this->_view->render('Регистрация');
    }

    public function actionRegister($params)
    {
        $login = htmlentities($_POST['login']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $check_password = htmlentities($_POST['check_password']);
        $validate_data = true;
        if ($login == '') {
            echo 'Логин не должен быть пустым<br>';
            $validate_data = false;
        }
        if ($email == '') {
            echo 'Почта не должна быть пустой<br>';
            $validate_data = false;
        }
        if ($password == '') {
            echo 'Пароль не должен быть пустым<br>';
            $validate_data = false;
        }
        if ($password != $check_password) {
            echo 'Пароли должы совпадать<br>';
            $validate_data = false;
        }
        if ($validate_data) {

            $this->_model->tryRegister($login, $email, $password);
        }
    }
}