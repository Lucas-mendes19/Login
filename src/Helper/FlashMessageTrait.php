<?php

namespace Project\System\Helper;

trait FlashMessageTrait
{
    public function defineMessage(string $type, string $message): void
    { 
        $_SESSION['type_menssage'] = $type;
        $_SESSION['menssage'] = $message;
    }
}