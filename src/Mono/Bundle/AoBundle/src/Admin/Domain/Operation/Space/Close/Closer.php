<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\Exception\SpaceWasNotClosed;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\Repository\WriterInterface;

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
