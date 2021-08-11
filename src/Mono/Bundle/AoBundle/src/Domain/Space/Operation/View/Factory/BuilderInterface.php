<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View\Factory;

use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
