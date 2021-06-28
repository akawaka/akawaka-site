<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Close;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Operation\Close\Exception\SpaceWasNotClosed;
use App\CMS\Domain\Space\Operation\Close\Repository\WriterInterface;

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
