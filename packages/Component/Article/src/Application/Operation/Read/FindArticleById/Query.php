<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindArticleById;

use Mono\Component\Article\Domain\Identifier\ArticleId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->id);
    }
}
