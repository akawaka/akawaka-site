<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Browse\DataProvider;

interface BrowseProviderInterface
{
    public function browse(): array;
}
