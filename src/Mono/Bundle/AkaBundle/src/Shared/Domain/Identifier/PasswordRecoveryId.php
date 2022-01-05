<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Identifier;

final class PasswordRecoveryId
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
