<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Publish;

use App\Context\Admin\Space\Domain\Publish\DataPersister\PublishPersisterInterface;
use App\Context\Admin\Space\Domain\Publish\Exception\SpaceWasNotPublished;
use App\Shared\Domain\Identifier\SpaceId;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private PublishPersisterInterface $persister,
    ) {
    }

    public function publish(SpaceId $id): void
    {
        try {
            $this->persister->publish($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotPublished($id);
        }
    }
}
