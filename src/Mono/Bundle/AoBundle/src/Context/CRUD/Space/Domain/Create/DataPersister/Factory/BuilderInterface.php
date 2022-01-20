<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
