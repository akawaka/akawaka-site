<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\View\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ReaderInterface
{
    public function get(ArticleId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
