<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface WriterInterface
{
    public function close(SpaceId $id): bool;
}
