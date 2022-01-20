<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Model\UserList;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\Exception\UnknownUserException;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(UserId $id): UserInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new UnknownUserException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readAll(): UserListInterface
    {
        $collection = new UserList();
        $results = $this->provider->getAll();

        foreach ($results as $result) {
            $collection->add($this->builder::build($result));
        }

        return $collection;
    }
}
