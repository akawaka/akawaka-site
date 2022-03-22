<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Delete;

use App\Context\Admin\Page\Domain\Delete\DataPersister\DeletePersisterInterface;
use App\Context\Admin\Page\Domain\Delete\Exception\UnableToDeleteException;
use App\Shared\Domain\Identifier\PageId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private DeletePersisterInterface $persister,
    ) {
    }

    public function delete(PageId $id): void
    {
        $deleted = $this->persister->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
