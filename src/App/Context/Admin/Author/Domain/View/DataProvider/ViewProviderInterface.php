<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View\DataProvider;

use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(AuthorId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
