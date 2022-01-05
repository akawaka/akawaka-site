<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Exception\UnknownUserException;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class UpdatePersister implements UpdatePersisterInterface
{
    public function __construct(
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

        $dbUser->update(
            $user->getUsername(),
            $user->getEmail(),
        );

        $this->repository->flush();

        return true;
    }
}
