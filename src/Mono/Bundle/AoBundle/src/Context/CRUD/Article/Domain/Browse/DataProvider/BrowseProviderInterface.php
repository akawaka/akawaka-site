<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Browse\DataProvider;

interface BrowseProviderInterface
{
    public function browse(): array;
}
