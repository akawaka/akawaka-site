<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Browse;

interface BrowserInterface
{
    public function browse(): array;
}
