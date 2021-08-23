<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Publish\Repository;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function publish(SpaceId $id): bool;
}
