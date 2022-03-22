<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class Code
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = mb_strtoupper($value);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
