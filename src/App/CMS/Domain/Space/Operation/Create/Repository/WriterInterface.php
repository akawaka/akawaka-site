<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create\Repository;

use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;

interface WriterInterface
{
    public function create(SpaceInterface $space): bool;
}
