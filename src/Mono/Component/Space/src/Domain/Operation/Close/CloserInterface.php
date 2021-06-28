<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Close;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

interface CloserInterface
{
    public function close(SpaceId $id): void;
}
