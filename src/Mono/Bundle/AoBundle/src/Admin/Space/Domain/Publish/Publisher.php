<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Publish;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\DataPersister\PublishPersisterInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\Exception\SpaceWasNotPublished;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

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
