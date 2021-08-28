<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\ValueObject;

use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Username
{
    private string $value;

    public function __construct(string $value)
    {
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
