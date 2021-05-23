<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\RemoveArticle;

use Mono\Component\Article\Domain\Identifier\ArticleId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getArticleId(): ArticleId
    {
        return new ArticleId($this->identifier);
    }
}
