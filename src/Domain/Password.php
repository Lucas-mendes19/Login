<?php

namespace Project\System\Domain;

class Password
{
    private string $password;

    public function __construct(string $password)
    {
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        
        if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase)
            throw new \InvalidArgumentException(
                "A senha deve ter pelo menos 8 caracteres e deve conter pelo menos um número, 
                uma letra maiúscula e uma letra minúscula.");

        $this->password = $password;
    }

    public function __toString()
    {
        return $this->password;
    }

    public function cipher(CipherPassword $cipher): self
    {
        $this->password = $cipher->cipher($this->password);
        return $this;
    }
}