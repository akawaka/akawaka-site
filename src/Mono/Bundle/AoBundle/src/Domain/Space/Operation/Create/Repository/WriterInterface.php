<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Repository;

use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\SpaceInterface;

interface WriterInterface
{
    public function create(SpaceInterface $space): bool;
}
