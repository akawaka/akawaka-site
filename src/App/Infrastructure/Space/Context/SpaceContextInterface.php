<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}
