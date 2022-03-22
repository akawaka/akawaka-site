<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Browse;

interface BrowserInterface
{
    public function browse(): array;
}
