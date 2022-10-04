<?php

namespace Project\System\Domain;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            throw new \InvalidArgumentException('Endereço de e-mail invalido.');

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }
}