<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View\Repository;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface ReaderInterface
{
    public function get(ArticleId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
