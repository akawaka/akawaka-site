<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Update;

use App\Context\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdaterInterface
{
    public function update(SpaceInterface $space): void;
}
