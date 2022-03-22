<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Create;

use App\Context\Admin\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface CreatorInterface
{
    public function create(CategoryInterface $category): void;
}
