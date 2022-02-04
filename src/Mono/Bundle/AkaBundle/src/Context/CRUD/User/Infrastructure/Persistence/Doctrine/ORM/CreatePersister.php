<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class CreatePersister implements CreatePersisterInterface
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private AdminUserRepository $repository,
    ) {
    }

    public function create(UserInterface $user): bool
    {
        $dbUser = $this->repository->getClass();
        $dbUser->create($user->getId(), $user->getUsername(), $user->getEmailAddress());

        $password = $this->passwordHasher->hashPassword($dbUser, $user->getPassword());
        $dbUser->updatePassword($password);

        $this->repository->add($dbUser);

        return true;
    }
}
