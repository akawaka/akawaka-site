<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Delete;

use Mono\Component\Article\Domain\Operation\Category\Delete\Exception\UnableToDeleteException;
use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Operation\Category\Delete\Repository\WriterInterface;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function delete(CategoryId $id): void
    {
        $deleted = $this->writer->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
