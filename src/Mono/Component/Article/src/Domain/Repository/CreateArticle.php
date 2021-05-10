<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\ArticleId;

interface CreateArticle
{
    public function insert(ArticleInterface $article): void;

    public function nextIdentity(): ArticleId;
}
