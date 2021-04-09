<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;

final class Command
{
    public function __construct(
        private ArticleInterface $article,
    ) {
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }
}
