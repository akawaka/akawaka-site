<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Domain\ValueObject;

final class Slug
{
    public function __construct(
        private string $value
    ) {
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
