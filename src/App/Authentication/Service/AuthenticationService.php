<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 29.10.18
 * Time: 18:52
 */

namespace App\Authentication\Service;

use App\Authentication\UserInterface;
use App\Authentication\UserToken;
use App\DataBase\DataBase;

class AuthenticationService implements AuthenticationServiceInterface
{
    private $db;
    private $key;

    public function  __construct()
    {
        $this->db = new DataBase();
        $this->key = 'iopdasojijioajscx,mzmc,z.xmiwqje';
    }

    public function authenticate($credentials)
    {


    }

    public function generateCredentials(UserInterface $user)
    {
        $cookie_structure = [
            'login' => $user->getLogin(),
            'password_hash' => $user->getPassword()
        ];

        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $cipher = sodium_crypto_secretbox(json_encode($cookie_structure), $nonce, $this->key);
        return base64_encode($nonce . $cipher);

        // в куках лежит идентификатор сессии. хранение либо вбд,либо прям php

    }
}