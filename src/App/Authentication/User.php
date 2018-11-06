<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 28.10.18
 * Time: 13:49
 */

namespace App\Authentication;


class User implements UserInterface
{
    private $id;
    private $login;
    private $password;
    private $email;
    private $birthday;

    public function __construct($id = 0, $login, $password, $email)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

}