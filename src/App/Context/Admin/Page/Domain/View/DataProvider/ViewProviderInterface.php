<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View\DataProvider;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(PageId $id): array;

    public function getBySlug(Slug $slug): array;
}
