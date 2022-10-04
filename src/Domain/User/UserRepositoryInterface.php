<?php

namespace Project\System\Domain\User;

use Project\System\Domain\Email;
use Project\System\Domain\User\User;

interface UserRepositoryInterface
{
    public function all(): array;

    public function findEmail(Email $email): User;
    
    public function insert(User $user): void;
    
}