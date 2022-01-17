<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\UpdatePasswordPersisterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\Exception\UnknownUserException;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UpdatePasswordPersister implements UpdatePasswordPersisterInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private AdminUserRepository $repository,
    ) {
    }

    public function update(UserInterface $user): bool
    {
        try {
            $dbUser = $this->repository->find($user->getId());
        } catch (NoResultException $exception) {
            throw new UnknownUserException($user->getId());
        }

        $password = $this->userPasswordHasher->hashPassword($dbUser, $user->getPassword());
        $dbUser->updatePassword($password);

        $this->repository->flush();

        return true;
    }
}
