<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\PublishArticle;

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
