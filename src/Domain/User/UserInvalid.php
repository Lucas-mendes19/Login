<?php

namespace Project\System\Domain\User;

class UserInvalid extends \DomainException
{
    public function __construct()
    {
        parent::__construct("Endereço de e-mail ou senha inválida.");
    }
}