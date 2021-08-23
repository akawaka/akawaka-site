<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Common\Identifier;

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
