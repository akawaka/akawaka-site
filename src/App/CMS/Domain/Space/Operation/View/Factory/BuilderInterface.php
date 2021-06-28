<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\View\Factory;

use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
