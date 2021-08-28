<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Model\SpaceInterface;

interface WriterInterface
{
    public function create(SpaceInterface $space): bool;
}
