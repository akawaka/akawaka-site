<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create\Model\SpaceInterface;

interface WriterInterface
{
    public function create(SpaceInterface $space): bool;
}
