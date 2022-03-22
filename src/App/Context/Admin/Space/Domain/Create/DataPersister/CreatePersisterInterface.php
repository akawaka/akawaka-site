<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create\DataPersister;

use App\Context\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface CreatePersisterInterface
{
    public function create(SpaceInterface $space): bool;
}
