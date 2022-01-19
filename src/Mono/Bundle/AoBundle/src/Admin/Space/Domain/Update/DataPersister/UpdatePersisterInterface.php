<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdatePersisterInterface
{
    public function update(SpaceInterface $space): bool;
}
