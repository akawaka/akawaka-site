<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Close\DataPersister;

use App\Shared\Domain\Identifier\SpaceId;

interface ClosePersisterInterface
{
    public function close(SpaceId $id): bool;
}
