<?php

declare(strict_types=1);

namespace Mono\Component\Core\Domain;

interface Identifier
{
    public function getValue(): string;
}
