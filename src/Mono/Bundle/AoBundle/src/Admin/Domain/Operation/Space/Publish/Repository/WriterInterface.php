<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Publish\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface WriterInterface
{
    public function publish(SpaceId $id): bool;
}
