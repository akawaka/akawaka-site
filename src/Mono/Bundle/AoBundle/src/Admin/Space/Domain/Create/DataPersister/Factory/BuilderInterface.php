<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
