<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Generator;

interface GeneratorInterface
{
    public static function generate(): string;
}
