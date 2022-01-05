<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface UpatePersisterInterface
{
    public function update(CategoryInterface $category): bool;
}
