<?php

namespace App\Authentication\Encoder;

class UserPasswordEncoder implements UserPasswordEncoderInterface
{
    /**
     * Метод принимает чистый пароль и возвращает его в зашифрованном виде.
     *
     * @param string $rawPassword
     * @param null|string $salt
     * @return string
     */
    public function encodePassword(string $rawPassword, ?string $salt = null): string {

    }
}