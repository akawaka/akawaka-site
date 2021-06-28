<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View\Repository;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface ReaderInterface
{
    public function get(CategoryId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
