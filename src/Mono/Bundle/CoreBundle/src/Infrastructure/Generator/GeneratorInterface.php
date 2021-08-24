<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Generator;

interface GeneratorInterface
{
    public static function generate(): string;
}
