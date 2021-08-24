<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
