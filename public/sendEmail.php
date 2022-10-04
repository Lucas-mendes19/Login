<?php

use Project\System\Infrastructure\User\SendEmailPhpMailer;

require_once(__DIR__.'/../vendor/autoload.php');

$address = "lorraineolegario16@gmail.com";
$subject = "Lucas > Lorraine";
$body = ":)";

$email = new SendEmailPhpMailer;
$succes = $email->send(
    $address,
    $subject,
    $body
);

echo $succes ? 'Envio Sucesso' : $email->getError();
