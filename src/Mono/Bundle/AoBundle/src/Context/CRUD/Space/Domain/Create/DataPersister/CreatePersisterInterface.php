<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface CreatePersisterInterface
{
    public function create(SpaceInterface $space): bool;
}
