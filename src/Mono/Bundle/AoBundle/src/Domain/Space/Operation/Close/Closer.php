<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Close;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Close\Exception\SpaceWasNotClosed;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Close\Repository\WriterInterface;

final class Closer implements CloserInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function close(SpaceId $id): void
    {
        try {
            $this->writer->close($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotClosed($id);
        }
    }
}
