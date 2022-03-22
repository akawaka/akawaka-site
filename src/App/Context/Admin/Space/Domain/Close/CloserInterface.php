<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Close;

use App\Shared\Domain\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
