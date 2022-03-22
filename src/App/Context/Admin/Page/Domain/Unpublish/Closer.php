<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Unpublish;

use App\Context\Admin\Page\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use App\Context\Admin\Page\Domain\Unpublish\Exception\CloseFailedException;
use App\Shared\Domain\Identifier\PageId;

final class Closer implements CloserInterface
{
    public function __construct(
        private UnpublishPersisterInterface $persister,
    ) {
    }

    public function close(PageId $id): void
    {
        $closed = $this->persister->close($id);

        if (false === $closed) {
            throw new CloseFailedException($id);
        }
    }
}
