<?php

namespace Project\System\Application\User\SendEmail;

interface SendEmail
{
    public function send(string $addresses, string $subject, string $body, string|array $attachments = [],
        string|array $ccs = [], string|array $bccs = []): bool;
}