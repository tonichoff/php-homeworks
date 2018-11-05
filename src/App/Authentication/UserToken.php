<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 28.10.18
 * Time: 14:39
 */

namespace App\Authentication;


class UserToken implements UserTokenInterface
{
    private $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function isAnonymous()
    {
        return !isset($this->user) || gettype($this->user) == 'NULL';
    }
}