<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse;

interface BrowserInterface
{
    public function browse(): array;
}
