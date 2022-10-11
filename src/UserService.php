<?php

namespace App;

use Doctrine\ORM\EntityManager;
use App\Domain\User;
use Psr\Log\LoggerInterface;

final class UserService
{
    private EntityManager $em;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function signUp(string $email): User
    {
        $newUser = new User($email);

        $this->logger->info("User {$email} signed up");

        $this->em->persist($newUser);
        $this->em->flush();

        return $newUser;
    }
}
