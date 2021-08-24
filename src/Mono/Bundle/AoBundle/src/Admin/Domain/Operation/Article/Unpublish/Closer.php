<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Unpublish\Exception\CloseFailedException;

final class Closer implements CloserInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function close(ArticleId $id): void
    {
        $closed = $this->writer->close($id);

        if (false === $closed) {
            throw new CloseFailedException($id);
        }
    }
}
