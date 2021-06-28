<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Common\Identifier;

final class CategoryId
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
