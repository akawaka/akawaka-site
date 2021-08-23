<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Close;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
