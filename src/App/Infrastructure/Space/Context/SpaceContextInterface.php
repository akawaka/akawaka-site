<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}
