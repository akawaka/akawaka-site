<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete\Exception\SpaceWasNotDeleted;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

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
