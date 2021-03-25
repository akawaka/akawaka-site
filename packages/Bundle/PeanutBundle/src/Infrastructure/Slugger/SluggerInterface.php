<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Infrastructure\Slugger;

interface SluggerInterface
{
    public function slugify(string $string, string $separator = '-');
}
