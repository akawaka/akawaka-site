<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Update;

use App\Context\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface UpdaterInterface
{
    public function update(CategoryInterface $category): void;
}
