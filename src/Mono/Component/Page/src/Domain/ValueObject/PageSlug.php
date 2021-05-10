<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\ValueObject;

use Mono\Component\Core\Infrastructure\Slugger\Slugger;

final class PageSlug
{
    public function __construct(
        private string $value
    ) {
        $this->value = Slugger::slugify($value);
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
