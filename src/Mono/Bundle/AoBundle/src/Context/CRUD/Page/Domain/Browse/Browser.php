<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Browse;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Browse\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Browse\DataProvider\BrowseProviderInterface;

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
