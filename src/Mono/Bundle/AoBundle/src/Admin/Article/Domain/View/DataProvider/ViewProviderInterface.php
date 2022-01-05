<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\View\DataProvider;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(ArticleId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
