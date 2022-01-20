<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete\Exception\UnableToDeleteException;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private DeletePersisterInterface $persister,
    ) {
    }

    public function delete(UserId $id): void
    {
        $deleted = $this->persister->delete($id);

        if (!$deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
