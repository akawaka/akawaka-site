<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Delete;

use Mono\Component\Article\Domain\Operation\Author\Delete\Exception\UnableToDeleteException;
use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Operation\Author\Delete\Repository\WriterInterface;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function delete(AuthorId $id): void
    {
        $deleted = $this->writer->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
