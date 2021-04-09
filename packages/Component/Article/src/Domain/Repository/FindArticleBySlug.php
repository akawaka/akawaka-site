<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\ValueObject\Slug;

interface FindArticleBySlug
{
    public function find(Slug $slug): ArticleInterface;
}
