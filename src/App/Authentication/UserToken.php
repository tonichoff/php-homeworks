<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 28.10.18
 * Time: 14:39
 */

namespace App\Authentication;

use App\Authentication\Repository\UserRepository;
use App\DataBase\DataBase;
use App\Authentication\Service\AuthenticationService;

class UserToken implements UserTokenInterface
{

    private $credentials;
    private $db;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        $this->db = new DataBase();
    }

    public function getUser(): ?UserInterface
    {
        $result_of_query = $this->db->query('find', 'Tokens', ['token' => $this->credentials]);
        if ($result_of_query) {
            $cur_time = date('Y-m-d H:i:s', time());
            if ($cur_time > $result_of_query['shelf_life']) {
                $this->db->query('delete', 'Tokens', ['id' => $result_of_query['id']]);
                unset($_COOKIE['auth_cookie']);
            }
            else {
                $user_rep = new UserRepository();
                return $user_rep->findById($result_of_query['user_id']);
            }
        }
        return NULL;
    }

    public function isAnonymous()
    {
        return empty($this->credentials);
    }
}