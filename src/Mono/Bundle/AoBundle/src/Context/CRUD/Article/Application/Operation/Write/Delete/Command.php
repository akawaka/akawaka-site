<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

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
