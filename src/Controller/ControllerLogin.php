<?php

namespace Project\System\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Project\System\Helper\RenderViewHtmlTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class ControllerLogin implements RequestHandlerInterface
{
    use RenderViewHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renders("user/login.php", [
            "title" => "Login Usuário"
        ]);

        return new Response(200, [], $html);
    }
}