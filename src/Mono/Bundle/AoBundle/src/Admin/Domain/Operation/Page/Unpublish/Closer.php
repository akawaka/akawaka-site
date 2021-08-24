<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish\Exception\CloseFailedException;

final class Closer implements CloserInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function close(PageId $id): void
    {
        $closed = $this->writer->close($id);

        if (false === $closed) {
            throw new CloseFailedException($id);
        }
    }
}
