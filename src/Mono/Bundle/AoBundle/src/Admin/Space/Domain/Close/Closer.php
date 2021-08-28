<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Close;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Close\Exception\SpaceWasNotClosed;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Close\Repository\WriterInterface;

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
