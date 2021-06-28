<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Close;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
