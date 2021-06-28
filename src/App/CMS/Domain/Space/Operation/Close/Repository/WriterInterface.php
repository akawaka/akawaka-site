<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Close\Repository;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function close(SpaceId $id): bool;
}
