<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Close\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface ClosePersisterInterface
{
    public function close(SpaceId $id): bool;
}
