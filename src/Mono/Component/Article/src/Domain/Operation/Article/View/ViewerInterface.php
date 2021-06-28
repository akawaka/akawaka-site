<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\View\Model\ArticleInterface;

interface ViewerInterface
{
    public function read(ArticleId $id): ?ArticleInterface;

    public function readBySlug(Slug $slug): ?ArticleInterface;

    public function readAll(): array;
}
