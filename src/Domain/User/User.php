<?php

namespace Project\System\Domain\User;

use Project\System\Domain\CipherPassword;
use Project\System\Domain\Email;
use Project\System\Domain\Password;
use Project\System\Domain\Telephone;

class User
{
    private Email $email;
    private string $name;
    private string $password;
    private array $telephone = [];

    public function __construct(Email $email, string $password, string $name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }  

    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function changePassword(Password $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function getTelephone(): array
    {
        return $this->telephone;
    }

    public function addTelephone(string $number): void
    {
        $telephone = new Telephone($number);
        $this->telephone[] = $telephone;
    }

    public function verifyPassword(CipherPassword $cipher, string $passwordText): bool
    {
        return $cipher->verify($passwordText, $this->password);
    }


}