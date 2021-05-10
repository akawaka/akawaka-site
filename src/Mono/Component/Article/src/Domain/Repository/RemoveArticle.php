<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\ArticleInterface;

interface RemoveArticle
{
    public function remove(ArticleInterface $article): void;
}
