<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\View;

use App\Context\Admin\Category\Domain\View\DataProvider\Model\CategoryInterface;
use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(CategoryId $id): ?CategoryInterface;

    public function readBySlug(Slug $slug): ?CategoryInterface;
}
