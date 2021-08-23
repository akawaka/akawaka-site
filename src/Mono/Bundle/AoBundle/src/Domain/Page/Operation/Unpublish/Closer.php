<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Unpublish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Bundle\AoBundle\Domain\Page\Operation\Unpublish\Exception\CloseFailedException;

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
