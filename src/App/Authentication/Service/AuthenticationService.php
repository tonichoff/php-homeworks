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

    public function  __construct()
    {
        $this->db = new DataBase();
    }

    public function authenticate($credentials)
    {
        $result_of_query = $this->db->query('find', 'Tokens', ['token' => $credentials]);
        $credentials = '';
        if ($result_of_query) {
            $cur_time = date('Y-m-d H:i:s', time());
            if ($cur_time > $result_of_query['shelf_life']) {
                $this->db->query('delete', 'Tokens', ['id' => $result_of_query['id']]);
                unset($_COOKIE['auth_cookie']);
            }
            else {
                $credentials = $result_of_query['token'];
            }
        }
        return new UserToken($credentials);
    }

    public function generateCredentials(UserInterface $user)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars .= "abcdefghijklmopqrstuvwxyz";
        $chars .= "0123456789";
        $chars .= "!@#$%^&*()";
        $max = strlen($chars);
        do {
            $token = '';
            for ($i = 0; $i < 64; $i++) {
                $token .= $chars[random_int(0, $max - 1)];
            }
            $result = $this->db->query('find', 'Tokens', ['token' => $token]);
        } while ($result);

        $this->db->query('insert', 'Tokens',
            [
                'token' => $token,
                'shelf_life' => date('Y-m-d H:i:s', time() + 60 * 5),
                'user_id' => $user->getId(),
            ]
        );

        return $token;
    }
}