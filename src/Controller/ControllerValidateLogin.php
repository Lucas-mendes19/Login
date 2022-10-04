<?php

namespace Project\System\Controller;

use Exception;
use Nyholm\Psr7\Response;
use Project\System\Domain\Email;
use Project\System\Domain\User\UserInvalid;
use Project\System\Helper\FlashMessageTrait;
use Project\System\Infrastructure\Service\TokenJwt;
use Project\System\Infrastructure\User\CipherPasswordPhp;
use Project\System\Infrastructure\User\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ControllerValidateLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if($_SERVER['REQUEST_METHOD'] !== "POST")
            return new Response(302, ['Location' => '/login']);

        $email = htmlspecialchars($request->getParsedBody()['email']);
        $password = htmlspecialchars($request->getParsedBody()['password']);

        try {
            $user = $this->userRepository->findEmail(new Email($email));

            if($user->verifyPassword(new CipherPasswordPhp, $password) === false)
                throw new UserInvalid();

        } catch (Exception $e) {
            $this->defineMessage("danger", $e->getMessage());
            return new Response(302, ['Location' => '/login']);
        }   

        $token = new TokenJwt();
        $tokenGenerate = $token->generateToken([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ]);

        $_SESSION['logged_user'] = $tokenGenerate->toString();

        $this->defineMessage("success", "Usuário logado com sucesso.");
        
        return new Response(302, ['Location' => '/controlPanel']);
    }
}