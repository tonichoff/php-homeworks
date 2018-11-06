<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 05.11.18
 * Time: 13:17
 */

namespace App\Controllers;

use App\Authentication\Repository\UserRepository;

class APIController extends Controller
{
    public function actionCheckInputRegister($data) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_password = $_POST['check_password'];
        $errors = [
            "login" => "",
            "email" => "",
            "password" => "",
            "check_password" => "",
        ];
        $validate = true;
        if (!$login) {
            $errors["login"] = "Поле 'Логин' не должно быть пустым";
            $validate = false;
        }
        else {
            $user_rep = new UserRepository();
            if ($user_rep->findByLogin($login)) {
                $errors['login'] = 'Пользователь с таким логином уже существует';
                $validate = false;
            }
        }
        if (!$email) {
            $errors["email"] = "Поле 'Почта' не должно быть пустым";
            $validate = false;
        }
        else {
            if ($user_rep->findByEmail($email)) {
                $errors['email'] = 'Пользователь с такой почтой уже существует';
                $validate = false;
            }
        }
        if ($password != $check_password) {
            $errors["check_password"] = "Пароли должны совпадать";
            $validate = false;
        }
        $errors["validate"] = $validate;
        echo json_encode($errors);
    }
}