<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface PublishPersisterInterface
{
    public function publish(SpaceId $id): bool;
}
