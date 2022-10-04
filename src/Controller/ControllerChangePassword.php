<?php

namespace Project\System\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Project\System\Helper\RenderViewHtmlTrait;
use Project\System\Infrastructure\Service\TokenJwt;

class ControllerChangePassword implements RequestHandlerInterface
{
    use RenderViewHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tokenCode = $request->getQueryParams()['token'];
        $token = new TokenJwt();
        $payload = $token->decodeToken($tokenCode);

        $html = $this->renders("user/changePassword.php", [
            "title" => "Redefinir senha",
            "token" => $tokenCode
        ]);

        return new Response(200, [], $html);
    }
}   