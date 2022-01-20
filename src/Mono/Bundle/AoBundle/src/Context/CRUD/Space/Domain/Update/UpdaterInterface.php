<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdaterInterface
{
    public function update(SpaceInterface $space): void;
}
