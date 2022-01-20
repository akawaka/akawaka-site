<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdatePersisterInterface
{
    public function update(SpaceInterface $space): bool;
}
