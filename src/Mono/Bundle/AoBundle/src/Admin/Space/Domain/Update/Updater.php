<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\Exception\SpaceWasNotUpdated;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
    ) {
    }

    public function update(SpaceInterface $space): void {
        try {
            $this->persister->update($space);
        } catch (\Exception $exception) {
            throw new SpaceWasNotUpdated($space->getId()->getValue());
        }
    }
}
