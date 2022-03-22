<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create;

use App\Context\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;
}
