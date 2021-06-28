<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Close;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\Close\Exception\CloseFailedException;

final class Closer implements CloserInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {}

    public function close(SpaceId $id): void
    {
        $closed = $this->writer->close($id);

        if (false === $closed) {
            throw new CloseFailedException($id);
        }
    }
}
