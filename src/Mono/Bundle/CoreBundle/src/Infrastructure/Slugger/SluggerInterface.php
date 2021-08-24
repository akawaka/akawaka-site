<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Slugger;

interface SluggerInterface
{
    public static function slugify(string $string, string $separator = '-'): string;
}
