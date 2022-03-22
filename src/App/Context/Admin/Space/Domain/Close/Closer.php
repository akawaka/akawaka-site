<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Close;

use App\Context\Admin\Space\Domain\Close\DataPersister\ClosePersisterInterface;
use App\Context\Admin\Space\Domain\Close\Exception\SpaceWasNotClosed;
use App\Shared\Domain\Identifier\SpaceId;

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
