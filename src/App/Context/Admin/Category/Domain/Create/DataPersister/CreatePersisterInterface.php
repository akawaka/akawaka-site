<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Create\DataPersister;

use App\Context\Admin\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface CreatePersisterInterface
{
    public function create(CategoryInterface $category): bool;
}
