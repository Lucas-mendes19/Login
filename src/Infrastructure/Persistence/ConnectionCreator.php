<?php

namespace Project\System\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = new PDO('sqlite: ./../../db.sqlite'); 
    }

    public function __toString()
    {
        return $this->PDO;
    }

    public function createConnection(): PDO
    {
        return new PDO('sqlite: ./../../db.sqlite');   
    }
}