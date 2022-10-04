<?php

namespace Project\System\Application\User;

use Project\System\Domain\CipherPassword;
use Project\System\Domain\Password;
use Project\System\Domain\User\User;
use Project\System\Domain\User\UserRepositoryInterface;

class ChangePassword
{
    public function __construct(UserRepositoryInterface $repositoryUser)
    {
        $this->repositoryUser = $repositoryUser;
    }

    public function change(User $user, Password $password): void
    {
        $user->changePassword($password);
        $this->repositoryUser->update($user);
    }
}