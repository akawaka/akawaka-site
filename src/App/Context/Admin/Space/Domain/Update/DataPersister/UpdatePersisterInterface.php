<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Update\DataPersister;

use App\Context\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdatePersisterInterface
{
    public function update(SpaceInterface $space): bool;
}
