<?php

namespace Project\System\Application\User\RegisterUser;

use Project\System\Domain\User\UserRepositoryInterface;
use Project\System\Factory\FactoryUser;

class RegisterUser
{
    public UserRepositoryInterface $repositoryUser;

    public function __construct(UserRepositoryInterface $repositoryUser)
    {
        $this->repositoryUser = $repositoryUser;
    }

    public function execute(RegisterUserDto $registryUser): void
    {
        $factoryUser = new FactoryUser();
        $user = $factoryUser->withEmailPasswordName(
            $registryUser->email,
            $registryUser->name,
            $registryUser->password
        )->user();
        
        $this->repositoryUser->insert($user);
    }
}