<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme\Space\Context;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}
