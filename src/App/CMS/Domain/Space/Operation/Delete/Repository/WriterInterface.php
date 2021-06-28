<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Delete\Repository;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function delete(SpaceId $id): bool;
}
