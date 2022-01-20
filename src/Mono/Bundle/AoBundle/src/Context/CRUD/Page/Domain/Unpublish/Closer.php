<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Unpublish;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Unpublish\Exception\CloseFailedException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

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
