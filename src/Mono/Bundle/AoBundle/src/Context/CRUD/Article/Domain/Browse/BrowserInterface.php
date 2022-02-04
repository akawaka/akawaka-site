<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Browse;

interface BrowserInterface
{
    public function browse(): array;
}
