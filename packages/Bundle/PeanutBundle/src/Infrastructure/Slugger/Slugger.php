<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Infrastructure\Slugger;

use Cocur\Slugify\Slugify;

final class Slugger implements SluggerInterface
{
    private $slugger;

    public function __construct()
    {
        $this->slugger = new Slugify();
    }

    public function slugify(string $string, string $separator = '-')
    {
        return $this->slugger->slugify($string, $separator);
    }
}
