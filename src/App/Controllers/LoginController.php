<?php

namespace App\Controllers;

use App\Authentication\Encoder\UserPasswordEncoder;
use App\Authentication\Repository\UserRepository;
use App\Authentication\Service\AuthenticationService;
use App\DataBase\DataBase;
use App\Views\View;

class LoginController extends Controller
{
    public function actionShow($parameters)
    {
        if (isset($_SESSION['user'])) {
            $this->_view = new View($this->_route, 'auth');
            $this->_view->render('Вход', $parameters);
        }
        else {
            $this->_view->render('Вход', $parameters);
        }
    }

    public function actionLogin($parameters)
    {
        $id = htmlentities($_POST['id']);
        $password = htmlentities($_POST['password']);

        $errors = $this->validate(
          [
              'id' => $id,
              'password' => $password,
          ]
        );

        if ($errors) {
            echo "Ну вы не вошли, увы. Потом буду об этом сообщать нормально";
        }
        else {
            $user_rep = new UserRepository();
            $auth_serv = new AuthenticationService();

            $user = $user_rep->findByEmail($id);
            if (!$user) {
                $user = $user_rep->findByLogin($id);
            }

            $cred = $auth_serv->generateCredentials($user);

            setcookie('auth_cookie', $cred);
            $this->_view = new View($this->_route, 'auth');
            $this->_view->render('Вход', $parameters);
        }
    }

    private function validate($values)
    {
        $errors = [];
        extract($values);
        if (!$id) {
            $errors['id'] = "Поле 'Идентификатор' не должно быть пустым";
        } else {
            $user_rep = new UserRepository();
            $user = $user_rep->findByLogin($id);
            if (!$user) {
                $user = $user_rep->findByEmail($id);
                if (!$user) {
                    $errors['id'] = 'Нет пользователя с таким логином или почтой';
                    return $errors;
                }
            }
            if (!password_verify($password, $user->getPassword())) {
                $errors['password'] = "Не верный пароль";
            }
        }
        return $errors;
    }
}