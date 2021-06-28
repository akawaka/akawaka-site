<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Create;

use Mono\Component\Space\Domain\Operation\Create\Model\SpaceInterface;

interface WriterInterface
{
    public function create(SpaceInterface $space): bool;
}
