<?php

namespace Project\System\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Project\System\Helper\RenderViewHtmlTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class ControllerRegisterUser implements RequestHandlerInterface
{
    use RenderViewHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renders("user/registerUser.php", [
            "title" => "Cadastro de Usuário"
        ]);

        return new Response(200, [], $html);
    }
}