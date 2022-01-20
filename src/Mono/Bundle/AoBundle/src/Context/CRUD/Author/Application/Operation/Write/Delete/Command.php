<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;

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
