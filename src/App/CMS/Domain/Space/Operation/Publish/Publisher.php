<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Publish;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Operation\Publish\Exception\SpaceWasNotPublished;
use App\CMS\Domain\Space\Operation\Publish\Repository\WriterInterface;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function publish(SpaceId $id): void
    {
        try {
            $this->writer->publish($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotPublished($id);
        }
    }
}
