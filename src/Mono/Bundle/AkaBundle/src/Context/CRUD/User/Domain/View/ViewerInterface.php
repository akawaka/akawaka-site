<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface ViewerInterface
{
    public function read(UserId $id): UserInterface;

    public function readAll(): UserListInterface;
}
