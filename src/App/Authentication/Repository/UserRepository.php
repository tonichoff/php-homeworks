<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 28.10.18
 * Time: 15:03
 */

namespace App\Authentication\Repository;
use App\Authentication\User;
use App\Authentication\UserInterface;
use App\DataBase\DataBase;
use phpDocumentor\Reflection\Types\Null_;

class UserRepository implements UserRepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function findById(int $id): ?UserInterface
    {
        $result = $this->db->query('find', 'Users', [ 'id' => $id ]);
        if ($result) {
            return new User($result['id'], $result['login'], $result['password'], $result['email']);
        }
        return null;
    }

    public function findByLogin(string $login): ?UserInterface
    {
        $result = $this->db->query('find', 'Users', [ 'login' => $login ]);
        if ($result) {
            return new User($result['id'], $result['login'], $result['password'], $result['email']);
        }
        return null;
    }

    public function findByEmail(string $email): ?UserInterface
    {
        $result = $this->db->query('find', 'Users', [ 'email' => $email ]);
        if ($result) {
            return new User($result['id'], $result['login'], $result['password'], $result['email']);
        }
        return null;
    }

    public function findByBirthday(string $birthday): ?UserInterface
    {
        $result = $this->db->query('find', 'Users', [ 'birthday' => $birthday]);
        if ($result) {
            return new User($result['id'], $result['login'], $result['password'], $result['email']);
        }
        return null;
    }

    public function save(UserInterface $user)
    {
        $values = [
            'login'    => $user->getLogin(),
            'password' => $user->getPassword(),
            'email'    => $user->getEmail(),
            'birthday' => $user->getBirthday(),
        ];
        $result = $this->db->query('insert', 'Users', $values);
        if ($result) {
            echo 'Пользователь сохранен';
        }
    }

}