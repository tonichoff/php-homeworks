<?php

namespace App\Controllers;

use App\DataBase\DataBase;
use App\Authentication\Repository\UserRepository;
use App\Authentication\User;

class RegisterController extends Controller
{
    public function actionShow($params)
    {
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
            $user_rep = new UserRepository();

            $uniq = true;
            if (gettype($user_rep->findByLogin($login)) != 'NULL') {
                echo 'Пользователь с таким логином уже существует<br>';
                $uniq = false;
            }
            if (gettype($user_rep->findByEmail($email)) != 'NULL') {
                echo 'Пользователь с такой почтой уже существует<br>';
                $uniq = false;
            }

            if ($uniq) {
                $user = new User(0, $login, $password, $email);
                $user_rep->save($user);
            }
        }
    }
}