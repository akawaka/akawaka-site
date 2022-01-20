<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface CreatePersisterInterface
{
    public function create(CategoryInterface $category): bool;
}
