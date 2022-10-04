<?php

namespace Project\System\Infrastructure\User;

use Project\System\Domain\CipherPassword;

class CipherPasswordPhp implements CipherPassword
{
    public function cipher(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
    public function verify(string $passwordText, string $passwordCipher): bool
    {
        return password_verify($passwordText, $passwordCipher);
    }
}