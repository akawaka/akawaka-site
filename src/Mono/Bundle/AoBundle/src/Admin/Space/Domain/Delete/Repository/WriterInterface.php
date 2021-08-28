<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Delete\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface WriterInterface
{
    public function delete(SpaceId $id): bool;
}
