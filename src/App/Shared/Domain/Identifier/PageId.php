<?php

declare(strict_types=1);

namespace App\Shared\Domain\Identifier;

final class PageId
{
    public function __construct(
        private string $value,
    ) {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
