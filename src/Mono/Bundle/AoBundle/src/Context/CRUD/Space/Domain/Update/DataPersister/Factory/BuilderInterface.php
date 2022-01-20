<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
