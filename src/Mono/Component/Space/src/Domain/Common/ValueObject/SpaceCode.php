<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Common\ValueObject;

final class SpaceCode
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
