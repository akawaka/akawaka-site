<?php

declare(strict_types=1);

namespace App\Shared\Domain\Identifier;

final class SpaceId
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
