<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Identifier;

use Mono\Component\Core\Domain\Identifier;
use Ramsey\Uuid\Uuid;

final class ChannelId implements Identifier
{
    private string $value;

    public function __construct(string $value = null)
    {
        $this->value = $value ?: Uuid::uuid4()->toString();
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
