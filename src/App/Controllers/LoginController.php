<?php

namespace App\Controllers;

use App\Authentication\Encoder\UserPasswordEncoder;
use App\Authentication\Repository\UserRepository;
use App\DataBase\DataBase;

class LoginController extends Controller
{
    public function actionShow($parameters)
    {
        $this->_view->render('Вход');
    }

    public function actionLogin($parameters)
    {
        $id = htmlentities($_POST['id']);
        $password = htmlentities($_POST['password']);
        $validate_data = true;
        if ($id == '') {
            echo 'Идентификатор не должен быть пустым<br>';
            $validate_data = false;
        }
        if ($password == '') {
            echo 'Пароль не должен быть пустым<br>';
            $validate_data = false;
        }
        if ($validate_data) {
            $user_rep = new UserRepository();
            $user = $user_rep->findByLogin($id);
            if (gettype($user) == 'NULL') {
                $user = $user_rep->findByEmail($id);
                if (gettype($user) == 'NULL') {
                    echo 'Не правильный идентификатор или пароль';
                }
            }
            if (gettype($user) != 'NULL') {
                if (password_verify($password, $user->getPassword())) {
                    echo 'Добро пожаловать, ' .  $user->getLogin();
                }
                else {
                    echo 'Не правильный идентификатор или пароль';
                }
            }
        }
    }
}