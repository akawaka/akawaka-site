<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface WriterInterface
{
    public function publish(SpaceId $id): bool;
}
