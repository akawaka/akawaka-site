<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;

interface SpaceContextInterface
{
    public function getSpace(): SpaceInterface;
}