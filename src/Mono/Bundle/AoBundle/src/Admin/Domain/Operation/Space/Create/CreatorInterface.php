<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;
}
