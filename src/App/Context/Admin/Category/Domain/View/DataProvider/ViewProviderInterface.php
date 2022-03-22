<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\View\DataProvider;

use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(CategoryId $id): array;

    public function getBySlug(Slug $slug): array;
}
