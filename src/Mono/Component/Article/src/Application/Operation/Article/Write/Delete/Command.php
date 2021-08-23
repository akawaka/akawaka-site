<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Write\Delete;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

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
