<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View\DataProvider;

use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(ArticleId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
