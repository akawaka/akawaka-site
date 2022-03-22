<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Delete;

use App\Context\Admin\Author\Domain\Delete\DataPersister\DeletePersisterInterface;
use App\Context\Admin\Author\Domain\Delete\Exception\UnableToDeleteException;
use App\Shared\Domain\Identifier\AuthorId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private DeletePersisterInterface $persister,
    ) {
    }

    public function delete(AuthorId $id): void
    {
        $deleted = $this->persister->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
