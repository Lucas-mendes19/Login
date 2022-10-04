<?php

namespace Project\System\Infrastructure\User;

use Exception;
use PDO;
use PDOException;
use Project\System\Domain\Email;
use Project\System\Domain\User\User;
use Project\System\Domain\User\UserInvalid;
use Project\System\Factory\FactoryUser;
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
        $sql = "SELECT user.email, user.password, user.name, telephone.number FROM user
                    LEFT JOIN telephone on telephone.userEmail = user.email;";

        $list = $this->PDO->createConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        $FactoryUser = new FactoryUser();

        foreach ($list as $dateUser) {
            if(!array_key_exists($dateUser['email'], $users)){
                $users[$dateUser['email']] = $FactoryUser->withEmailPasswordName(
                    $dateUser['email'],
                    $dateUser['password'],
                    $dateUser['name'],
                )->user();
            }

            if(!empty($dateUser['number']))
                $users[$dateUser['email']]->addTelephone($dateUser['number']);
        }

        return array_values($users);
	}

	public function findEmail(Email $email): User
	{
        $sql = "SELECT user.email, user.password, user.name, telephone.number FROM user
                    LEFT JOIN telephone on telephone.userEmail = user.email 
                    WHERE user.email = ?;";

		$sql = $this->PDO->createConnection()->prepare($sql);
		$sql->execute([$email]);

        $dateUser = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($dateUser) === 0)
            throw new UserInvalid();
        
        return $this->mapUser($dateUser);
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

        $sql = "INSERT INTO telephone (number, userEmail) VALUES (:number, :userEmail)";
        $stmt = $this->PDO->createConnection()->prepare($sql);
        $stmt->bindValue('userEmail', $user->getEmail());
        
        foreach ($user->getTelephone() as $telephone) {
            $stmt->bindValue('number', $telephone->getNumber());
            $stmt->execute();
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

        $sql = "INSERT INTO telephone (number, userEmail) VALUES (:number, :userEmail)";
        $stmt = $this->PDO->createConnection()->prepare($sql);
        $stmt->bindValue('userEmail', $user->getEmail());
        
        foreach ($user->getTelephone() as $telephone) {
            $stmt->bindValue('number', $telephone->getNumber());
            $stmt->execute();
        }
	}

    private function mapUser(array $date): User
    {
        $line = $date[0];
        $FactoryUser = new FactoryUser();
        $user = $FactoryUser->withEmailPasswordName(
            $line['email'],
            $line['password'],
            $line['name']
        );

        foreach ($date as $telephone){
            if(!empty($telephone['number']))
                $user->addTelephone($telephone['number']);
        }

        return $user->user();
    }
}