<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface UpdaterInterface
{
    public function update(CategoryInterface $category): void;
}
