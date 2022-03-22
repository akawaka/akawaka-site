<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Operation\Write\Delete;

use App\Shared\Domain\Identifier\ArticleId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->identifier);
    }
}
