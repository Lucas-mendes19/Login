<?php

namespace Project\System\Domain;

interface CipherPassword
{
    public function cipher(string $password): string;
    public function verify(string $passwordText, string $passwordCipher): bool;
}