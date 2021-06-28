<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create;

use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;
}
