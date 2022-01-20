<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Close;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Close\DataPersister\ClosePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Close\Exception\SpaceWasNotClosed;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class Closer implements CloserInterface
{
    public function __construct(
        private ClosePersisterInterface $persister,
    ) {
    }

    public function close(SpaceId $id): void
    {
        try {
            $this->persister->close($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotClosed($id);
        }
    }
}
