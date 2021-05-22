<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Repository;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\ValueObject\SpaceCode;

interface FindSpaceByCode
{
    public function find(SpaceCode $id): ?SpaceInterface;
}
