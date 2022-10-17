<?php

namespace Project\System\Controller;

use Exception;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Project\System\Application\User\ChangePassword;
use Project\System\Domain\Email;
use Project\System\Domain\Password;
use Project\System\Helper\FlashMessageTrait;
use Project\System\Infrastructure\Service\TokenJwt;
use Project\System\Infrastructure\User\CipherPasswordPhp;
use Project\System\Infrastructure\User\UserRepository;

class ControllerValidateChangePassword implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST")
            return new Response(302, ['Location' => '/login']);

        $tokenCode = $request->getQueryParams()['token'];
        $token = new TokenJwt();
        $payload = $token->decodeToken($tokenCode);
        $email = htmlspecialchars($payload['email']);

        $password = htmlspecialchars($request->getParsedBody()['password']);
        $confirmPassword = htmlspecialchars($request->getParsedBody()['confirmPassword']);

        try {
            $user = $this->userRepository->findEmail(new Email($email));
            if ($password !== $confirmPassword)
                throw new Exception("Senhas não são iguais.");

            $password = new Password($password);

            $changePassword = new ChangePassword($this->userRepository);
            $changePassword->change($user, $password->cipher(new CipherPasswordPhp));
        } catch (Exception $e) {
            $this->defineMessage("danger", $e->getMessage());
            return new Response(302, ['Location' => "/change/user/password?token=$tokenCode"]);
        }

        $this->defineMessage("success", "Senha redefinida com sucesso.");
        return new Response(200, ['location' => '/login']);
    }
}   