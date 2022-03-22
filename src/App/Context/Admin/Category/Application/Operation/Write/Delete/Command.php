<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Operation\Write\Delete;

use App\Shared\Domain\Identifier\CategoryId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): CategoryId
    {
        return new CategoryId($this->identifier);
    }
}
