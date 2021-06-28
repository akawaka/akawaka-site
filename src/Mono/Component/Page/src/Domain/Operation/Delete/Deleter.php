<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Delete;

use Mono\Component\Page\Domain\Operation\Delete\Exception\UnableToDeleteException;
use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Operation\Delete\Repository\WriterInterface;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function delete(PageId $id): void
    {
        $deleted = $this->writer->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
