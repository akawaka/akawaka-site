<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Component\Space\Domain\Entity\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}
