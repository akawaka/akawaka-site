<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Delete;

use App\Context\Admin\Category\Domain\Delete\DataPersister\DeletePersisterInterface;
use App\Context\Admin\Category\Domain\Delete\Exception\UnableToDeleteException;
use App\Shared\Domain\Identifier\CategoryId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private DeletePersisterInterface $persister,
    ) {
    }

    public function delete(CategoryId $id): void
    {
        $deleted = $this->persister->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
