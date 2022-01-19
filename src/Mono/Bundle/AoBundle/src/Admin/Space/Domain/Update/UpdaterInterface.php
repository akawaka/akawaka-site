<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface UpdaterInterface
{
    public function update(SpaceInterface $space): void;
}
