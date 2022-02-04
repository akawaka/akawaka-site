<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserList;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\BrowseProviderInterface;

final class Browser implements BrowserInterface
{
    public function __construct(
        private BrowseProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function browse(): UserListInterface
    {
        $collection = new UserList();
        $results = $this->provider->browse();

        foreach ($results as $result) {
            $collection->add($this->builder::build($result));
        }

        return $collection;
    }
}
