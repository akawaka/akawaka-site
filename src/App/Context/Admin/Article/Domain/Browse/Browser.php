<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Browse;

use App\Context\Admin\Article\Domain\Browse\DataProvider\Factory\BuilderInterface;
use App\Context\Admin\Article\Domain\Browse\DataProvider\BrowseProviderInterface;

final class Browser implements BrowserInterface
{
    public function __construct(
        private BrowseProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function browse(): array
    {
        $collection = [];
        $results = $this->provider->browse();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
