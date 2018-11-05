<?php

namespace App\Controllers;

use App\DataBase\DataBase;
use App\Authentication\Repository\UserRepository;
use App\Authentication\User;
use App\Authentication\Encoder\UserPasswordEncoder;

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

        $errors = $this->validate(
            [
                'login' => $login,
                'email' => $email,
                'password' => $password,
                'check_password' => $check_password,
            ]
        );

        if ($errors) {
            var_dump($errors);
        }
        else {
            $encoder = new UserPasswordEncoder();
            $password = $encoder->encodePassword($password);

            $user = new User(0, $login, $password, $email);

            $user_rep = new UserRepository();
            $user_rep->save($user);
            echo "Всё классно";
        }
    }

    private function validate($values) {
        extract($values);
        $errors = [];
        if (!$login) {
            $errors['login'] = "Поле 'Логин' не должно быть пустым";
        }
        if (!$email) {
            $errors['email'] = "Поле 'Почта' не должно быть пустым";
        }
        if ($password != $check_password) {
            $errors['check_password'] = "Пароли должны совпадать";
        }

        if (!$errors) {
            $user_rep = new UserRepository();
            if ($user_rep->findByLogin($login)) {
                $errors['login'] = 'Пользователь с таким логином уже существует';
            }
            if ($user_rep->findByEmail($email)) {
                $errors['email'] = 'Пользователь с такой почтой уже существует';
            }
        }
        return $errors;
    }
}