<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Delete;

use App\Context\Admin\Space\Domain\Delete\DataPersister\DeletePersisterInterface;
use App\Context\Admin\Space\Domain\Delete\Exception\SpaceWasNotDeleted;
use App\Shared\Domain\Identifier\SpaceId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private DeletePersisterInterface $persister,
    ) {
    }

    public function delete(SpaceId $id): void
    {
        try {
            $this->persister->delete($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotDeleted($id);
        }
    }
}
