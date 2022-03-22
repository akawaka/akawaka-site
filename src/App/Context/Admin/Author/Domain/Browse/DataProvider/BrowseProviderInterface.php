<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Browse\DataProvider;

interface BrowseProviderInterface
{
    public function browse(): array;
}
