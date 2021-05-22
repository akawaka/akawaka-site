<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Repository;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Identifier\SpaceId;

interface CreateSpace
{
    public function insert(SpaceInterface $space): void;

    public function nextIdentity(): SpaceId;
}
