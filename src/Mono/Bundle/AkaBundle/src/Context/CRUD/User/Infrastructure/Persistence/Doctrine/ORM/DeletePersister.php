<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class DeletePersister implements DeletePersisterInterface
{
    public function __construct(
        private AdminUserRepository $repository
    ) {
    }

    public function delete(UserId $id): bool
    {
        $dbUser = $this->repository->find($id);
        $this->repository->delete($dbUser);

        return true;
    }
}
