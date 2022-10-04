<?php

namespace Project\System\Factory;

use Project\System\Domain\Email;
use Project\System\Domain\Password;
use Project\System\Domain\User\User;

class FactoryUser
{
    private User $user;
    
    public function withEmailPasswordName(string $email, string $password, string $name): self
    {
        $this->user = new User(new Email($email), $password, $name);
        return $this;
    }

    public function addTelephone(string $telephone): self
    {
        $this->user->addTelephone($telephone);
        return $this;
    }

    public function user(): User
    {
        return $this->user;
    }
}