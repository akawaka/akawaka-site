<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}
