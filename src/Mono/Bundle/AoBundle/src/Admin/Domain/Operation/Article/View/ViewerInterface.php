<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Model\ArticleInterface;

interface ViewerInterface
{
    public function read(ArticleId $id): ?ArticleInterface;

    public function readBySlug(Slug $slug): ?ArticleInterface;

    public function readAll(): array;
}
