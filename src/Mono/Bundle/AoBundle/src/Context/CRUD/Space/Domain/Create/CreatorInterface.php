<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;
}
