<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Repository;

use Mono\Component\Space\Domain\Entity\SpaceInterface;

interface FindSpaceByHostname
{
    public function find(string $hostname): ?SpaceInterface;
}
