<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\Exception\SpaceWasNotUpdated;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
    ) {
    }

    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description,
        ?string $theme,
    ): void {
        try {
            $this->persister->update(
                $id,
                $name,
                $url,
                $description,
                $theme,
            );
        } catch (\Exception $exception) {
            throw new SpaceWasNotUpdated($id->getValue());
        }
    }
}
