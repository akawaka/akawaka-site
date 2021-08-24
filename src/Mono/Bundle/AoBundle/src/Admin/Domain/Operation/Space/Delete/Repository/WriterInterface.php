<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface WriterInterface
{
    public function delete(SpaceId $id): bool;
}
