<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Read\FindById;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

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
