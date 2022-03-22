<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Write\Delete;

use App\Shared\Domain\Identifier\AuthorId;

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
