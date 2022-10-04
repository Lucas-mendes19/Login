<?php

namespace Project\System\Controller;

use Nyholm\Psr7\Response;
use Project\System\Helper\FlashMessageTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ControllerLogout implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        unset($_SESSION['logged_user']);

        $this->defineMessage("success", "Usuário deslogado com sucesso.");
        return new Response(302, ['location' => '/login']);
    }
}