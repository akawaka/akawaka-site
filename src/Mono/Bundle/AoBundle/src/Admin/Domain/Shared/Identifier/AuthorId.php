<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier;

final class AuthorId
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
