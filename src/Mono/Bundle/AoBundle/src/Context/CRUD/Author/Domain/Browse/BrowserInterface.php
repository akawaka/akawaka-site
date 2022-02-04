<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Browse;

interface BrowserInterface
{
    public function browse(): array;
}
