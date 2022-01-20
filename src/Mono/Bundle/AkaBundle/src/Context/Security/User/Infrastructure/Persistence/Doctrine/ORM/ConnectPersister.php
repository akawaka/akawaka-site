<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\ConnectPersisterInterface;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception\UnableToConnectException;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception\UnknownUserException;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class ConnectPersister implements ConnectPersisterInterface
{
    public function __construct(
        private AdminUserRepository $repository
    ) {
    }

    public function authenticate(UserInterface $user): bool
    {
        try {
            $dbUser = $this->repository->findByUsername($user->getUsername());
        } catch (NoResultException $exception) {
            throw new UnknownUserException($user->getUsername());
        }

        $dbUser->connect();

        try {
            $this->repository->flush();
        } catch (ORMException $exception) {
            throw new UnableToConnectException($user->getUsername()->getValue());
        }
    }
}
