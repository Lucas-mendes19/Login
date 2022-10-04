<?php

namespace Project\System\Controller;

use Exception;
use InvalidArgumentException;
use Nyholm\Psr7\Response;
use Project\System\Application\User\RegisterUser\RegisterUser;
use Project\System\Application\User\RegisterUser\RegisterUserDto;
use Project\System\Domain\Password;
use Project\System\Helper\FlashMessageTrait;
use Project\System\Infrastructure\User\CipherPasswordPhp;
use Project\System\Infrastructure\User\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ControllerValidateRegisterUser implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if($_SERVER['REQUEST_METHOD'] !== "POST")
            return new Response(302, ['Location' => '/register/user']);

        $email = htmlspecialchars($request->getParsedBody()['email']);
        $name = htmlspecialchars($request->getParsedBody()['name']);
        $password = htmlspecialchars($request->getParsedBody()['password']);
        $confirmPassword = htmlspecialchars($request->getParsedBody()['confirmPassword']);

        if(empty($email) ||empty($password) || empty($name) || empty($confirmPassword)){
            $this->defineMessage("danger", "Preencha os campos obrigatórios.");
            return new Response(302, ['Location' => '/register/user']);
        }

        try {
            $password = new Password($password);
            if ($password !== $confirmPassword)
                throw new Exception("Senhas não são iguais.");

            $userDto = new RegisterUserDto(
                $email,
                $password->cipher(new CipherPasswordPhp),
                $name
            );
            $registerUser = new RegisterUser(new UserRepository);
            $registerUser->execute($userDto);
        } catch (Exception $e) {
            $this->defineMessage("danger", $e->getMessage());
            return new Response(302, ['Location' => '/register/user']);
        }   

        $this->defineMessage("success", "Usuário cadastrado com sucesso.");
        
        return new Response(200, ['location' => '/register/user']);
    }
}