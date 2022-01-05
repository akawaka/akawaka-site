<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish\Exception\CloseFailedException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

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
