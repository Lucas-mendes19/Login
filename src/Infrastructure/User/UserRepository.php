<?php

namespace Project\System\Infrastructure\User;

use Exception;
use PDO;
use PDOException;
use Project\System\Domain\Email;
use Project\System\Domain\User\User;
use Project\System\Domain\User\UserInvalid;
use Project\System\Infrastructure\Persistence\ConnectionCreator;
use Project\System\Domain\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $PDO;

    public function __construct()
    {
        $this->PDO = new ConnectionCreator();
    }

	public function all(): array
	{
        $sql = "SELECT user.email, user.password, user.name FROM user;";

        $list = $this->PDO->createConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($list as $dateUser) {
            if(!array_key_exists($dateUser['email'], $users)){
                $users[$dateUser['email']] = User::withEmailPasswordName(
                    $dateUser['email'],
                    $dateUser['password'],
                    $dateUser['name'],
                );
            }
        }

        return array_values($users);
	}

	public function findEmail(Email $email): User
	{
        $sql = "SELECT user.email, user.password, user.name FROM user WHERE user.email = ?;";

		$sql = $this->PDO->createConnection()->prepare($sql);
		$sql->execute([$email]);

        $dateUser = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($dateUser) === 0)
            throw new UserInvalid();
        
        $line = $dateUser[0];
        $user = User::withEmailPasswordName(
            $line['email'],
            $line['password'],
            $line['name']
        );

        return $user;
	}

	public function insert(User $user): void
	{
        $sql = 'INSERT INTO user (password, name, email) VALUES (:password, :name, :email);';
        $stmt = $this->PDO->createConnection()->prepare($sql);
        try {
            $stmt->bindValue('password', $user->getPassword());
            $stmt->bindValue('name', $user->getName());
            $stmt->bindValue('email', $user->getEmail());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Endereço de e-mail já existente.');
        }
	}

	public function update(User $user): void
	{
        $sql = 'UPDATE user SET password = :password, name = :name WHERE email = :email;';
        $stmt = $this->PDO->createConnection()->prepare($sql);
        try {
            $stmt->bindValue('password', $user->getPassword());
            $stmt->bindValue('name', $user->getName());
            $stmt->bindValue('email', $user->getEmail());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Endereço de e-mail já existente.');
        }
	}
}