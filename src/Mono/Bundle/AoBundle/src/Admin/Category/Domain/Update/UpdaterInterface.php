<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface UpdaterInterface
{
    public function update(CategoryInterface $category): void;
}
