<?php

$path = __DIR__."/../db.sqlite";
$pdo = new PDO('sqlite:' . $path);   

$pdo->exec("CREATE TABLE user ( 
    email TEXT PRIMARY KEY,
    name TEXT,
    password TEXT
)");

