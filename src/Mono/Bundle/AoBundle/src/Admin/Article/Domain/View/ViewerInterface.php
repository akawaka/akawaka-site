<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Model\ArticleInterface;

interface ViewerInterface
{
    public function read(ArticleId $id): ?ArticleInterface;

    public function readBySlug(Slug $slug): ?ArticleInterface;

    public function readAll(): array;
}
