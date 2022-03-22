<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Update\DataPersister;

use App\Context\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface UpatePersisterInterface
{
    public function update(CategoryInterface $category): bool;
}
