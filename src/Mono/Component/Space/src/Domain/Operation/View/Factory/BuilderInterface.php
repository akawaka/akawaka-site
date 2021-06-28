<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View\Factory;

use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
