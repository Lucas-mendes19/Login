<?php

$path = __DIR__."/../db.sqlite";
$pdo = new PDO('sqlite:' . $path);   

$pdo->exec("CREATE TABLE user ( 
    email TEXT PRIMARY KEY,
    name TEXT,
    password TEXT
)");

$pdo->exec("CREATE TABLE telephone (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    number TEXT,
    userEmail INTEGER,
    FOREIGN KEY(userEmail) REFERENCES user(email)
)");

