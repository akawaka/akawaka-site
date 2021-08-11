<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Create;

use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;
}
