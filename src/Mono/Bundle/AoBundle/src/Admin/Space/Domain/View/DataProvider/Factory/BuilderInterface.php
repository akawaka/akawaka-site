<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Factory;

use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
