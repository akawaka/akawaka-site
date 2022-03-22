<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Operation\Read\FindById;

use App\Shared\Domain\Identifier\ArticleId;

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
