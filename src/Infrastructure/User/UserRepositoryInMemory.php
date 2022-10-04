<?php

namespace Project\System\Infrastructure\User;

use Exception;
use Project\System\Domain\Email;
use Project\System\Domain\User\User;
use Project\System\Domain\User\UserInvalid;
use Project\System\Domain\User\UserRepositoryInterface;

class UserRepositoryInMemory implements UserRepositoryInterface
{
    private array $users = [];

    public function all(): array
    {
        return $this->users;
    }

    public function findEmail(Email $email): User
    {
        $userFilter = array_filter($this->users, fn (User $user) => $user->getEmail() == $email);

        if(count($userFilter) === 0)
            throw new UserInvalid($email);

        if(count($userFilter) > 1)
            throw new Exception('Ocorreu um erro de duplicidade ao buscar ususario.');

        return $userFilter[0];
    }

    public function insert(User $user): void
    {
        $this->users[] = $user;
    }
}