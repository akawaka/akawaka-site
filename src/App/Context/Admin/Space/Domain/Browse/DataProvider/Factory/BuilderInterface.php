<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Space\Domain\Browse\DataProvider\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
