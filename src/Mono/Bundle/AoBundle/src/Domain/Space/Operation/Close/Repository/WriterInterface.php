<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Close\Repository;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function close(SpaceId $id): bool;
}
