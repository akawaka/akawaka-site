<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete\Exception\UnableToDeleteException;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete\Repository\WriterInterface;

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
