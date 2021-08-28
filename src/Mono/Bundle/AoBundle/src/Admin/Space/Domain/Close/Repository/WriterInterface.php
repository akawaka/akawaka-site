<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Close\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface WriterInterface
{
    public function close(SpaceId $id): bool;
}
