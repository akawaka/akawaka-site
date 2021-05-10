<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Identifier;

use Mono\Component\Core\Domain\Identifier;
use Ramsey\Uuid\Uuid;

final class PageId implements Identifier
{
    public function __construct(
        private ?string $value = null
    ) {
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
