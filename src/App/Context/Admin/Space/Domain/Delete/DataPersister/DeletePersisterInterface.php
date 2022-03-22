<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Delete\DataPersister;

use App\Shared\Domain\Identifier\SpaceId;

interface DeletePersisterInterface
{
    public function delete(SpaceId $id): bool;
}
