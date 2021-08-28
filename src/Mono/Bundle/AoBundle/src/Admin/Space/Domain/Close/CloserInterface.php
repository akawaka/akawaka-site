<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Close;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
