<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Browse\DataProvider;

interface BrowseProviderInterface
{
    public function browse(): array;
}
