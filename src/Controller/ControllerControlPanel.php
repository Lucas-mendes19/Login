<?php

namespace Project\System\Controller;

use Nyholm\Psr7\Response;
use Project\System\Helper\RenderViewHtmlTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ControllerControlPanel implements RequestHandlerInterface
{
    use RenderViewHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renders("user/controlPanel.php", [
            "title" => "Painel de Controle"
        ]);

        return new Response(200, [], $html);
    }
}