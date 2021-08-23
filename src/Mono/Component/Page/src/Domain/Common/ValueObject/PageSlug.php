<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Common\ValueObject;

final class PageSlug
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
