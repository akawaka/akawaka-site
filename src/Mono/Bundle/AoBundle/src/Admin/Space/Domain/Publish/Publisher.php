<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Publish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\Exception\SpaceWasNotPublished;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\Repository\WriterInterface;

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
