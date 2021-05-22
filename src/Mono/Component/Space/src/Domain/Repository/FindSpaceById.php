<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Repository;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Identifier\SpaceId;

interface FindSpaceById
{
    public function find(SpaceId $id): ?SpaceInterface;
}
