<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Author\Write\Delete;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): AuthorId
    {
        return new AuthorId($this->identifier);
    }
}
