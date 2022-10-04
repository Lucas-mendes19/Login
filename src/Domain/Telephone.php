<?php

namespace Project\System\Domain;

class Telephone
{
    private string $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function __toString()
    {
        return $this->number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}