<?php
require_once __DIR__ . '/../repositories/UserRepository.php';

class UserService
{
    private $repository;


    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function verifyAndGetUser($email, $password)
    {
        return $this->repository->verifyAndGetUser($email, $password);
    }


    public function hashPassword($password): array
    {
        try {
            $salt = bin2hex(random_bytes(32));
            $hashPassword = password_hash($password . $salt, PASSWORD_ARGON2I);
            return [$hashPassword, $salt];
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }


    public function createNewUser($userDetails): bool
    {
        $hashPasswordWithSalt = $this->hashPassword($userDetails["password"]);
        $userDetails["hashPassword"] = $hashPasswordWithSalt[0];
        $userDetails["salt"] = $hashPasswordWithSalt[1];
        return $this->repository->insertUserInDatabase($userDetails);
    }

    public function CheckUserExistenceByEmail($email) :bool{
        return $this->repository->CheckUserEmailExistence($email);
    }
}
