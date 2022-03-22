<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Unpublish;

use App\Context\Admin\Article\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use App\Context\Admin\Article\Domain\Unpublish\Exception\CloseFailedException;
use App\Shared\Domain\Identifier\ArticleId;

final class Closer implements CloserInterface
{
    public function __construct(
        private UnpublishPersisterInterface $persister,
    ) {
    }

    public function close(ArticleId $id): void
    {
        $closed = $this->persister->close($id);

        if (false === $closed) {
            throw new CloseFailedException($id);
        }
    }
}
