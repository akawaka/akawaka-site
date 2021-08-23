<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Delete;

use Mono\Component\Article\Domain\Operation\Article\Delete\Exception\UnableToDeleteException;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Operation\Article\Delete\Repository\WriterInterface;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function delete(ArticleId $id): void
    {
        $deleted = $this->writer->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
