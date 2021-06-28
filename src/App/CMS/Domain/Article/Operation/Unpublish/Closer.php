<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Unpublish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use App\CMS\Domain\Article\Operation\Unpublish\Exception\CloseFailedException;

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
