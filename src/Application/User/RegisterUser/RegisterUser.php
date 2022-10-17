<?php

namespace Project\System\Application\User\RegisterUser;

use Project\System\Domain\User\User;
use Project\System\Domain\User\UserRepositoryInterface;

class RegisterUser
{
    public UserRepositoryInterface $repositoryUser;

    public function __construct(UserRepositoryInterface $repositoryUser)
    {
        $this->repositoryUser = $repositoryUser;
    }

    public function execute(RegisterUserDto $registryUser): void
    {
        $user = User::withEmailPasswordName(
            $registryUser->email,
            $registryUser->name,
            $registryUser->password
        );
        
        $this->repositoryUser->insert($user);
    }
}