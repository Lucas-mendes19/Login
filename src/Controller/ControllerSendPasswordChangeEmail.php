<?php

namespace Project\System\Controller;

use Exception;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Project\System\Domain\Email;
use Project\System\Helper\FlashMessageTrait;
use Project\System\Infrastructure\Service\TokenJwt;
use Project\System\Infrastructure\User\SendEmailPhpMailer;
use Project\System\Infrastructure\User\UserRepository;

class ControllerSendPasswordChangeEmail implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if($_SERVER['REQUEST_METHOD'] !== "POST")
            return new Response(302, ['Location' => '/login']);

        $email = htmlspecialchars($request->getParsedBody()['email']);

        try {
            $user = $this->userRepository->findEmail(new Email($email));
        } catch (Exception $e) {
            $this->defineMessage("danger", "Não foi possível recuperar sua senha!");
            return new Response(302, ['Location' => '/login']);
        }

        $token = new TokenJwt();
        $token->setExpiration(1800);
        $tokenCode = $token->generateToken([
            'email' => $user->getEmail()
        ])->toString();
        
        $address = $user->getEmail();
        $subject = "Recuperação de senha";
        $body = getenv('ABSOLUTE_PATH')."/change/user/password?token=$tokenCode";

        try {           
            $mail = new SendEmailPhpMailer;
            $mail->send( $address, $subject, $body );
        } catch (\Throwable $th) {
            $this->defineMessage("danger", "Ocorreu um error ao enviar o e-mail.");
            return new Response(302, ['location' => '/login']);
        }

        $this->defineMessage("success", "E-mail de recuperação de senha enviado com sucesso.");
        return new Response(200, ['location' => '/login']);
    }
}