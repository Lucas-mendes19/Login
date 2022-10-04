<?php

namespace Project\System\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Project\System\Helper\RenderViewHtmlTrait;

class ControllerRecoverPassword implements RequestHandlerInterface
{
    use RenderViewHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renders("user/recoverPassword.php", [
            "title" => "esqueceu senha"
        ]);

        return new Response(200, [], $html);
    }
}