<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Delete\Repository;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function delete(SpaceId $id): bool;
}
