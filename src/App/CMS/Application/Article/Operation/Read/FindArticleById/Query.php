<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindArticleById;

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
