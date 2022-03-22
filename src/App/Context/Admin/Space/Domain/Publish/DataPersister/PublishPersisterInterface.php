<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Publish\DataPersister;

use App\Shared\Domain\Identifier\SpaceId;

interface PublishPersisterInterface
{
    public function publish(SpaceId $id): bool;
}
