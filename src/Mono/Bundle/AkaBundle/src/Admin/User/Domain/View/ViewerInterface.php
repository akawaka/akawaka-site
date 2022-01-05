<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\View;

use Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Model\UserInterface;

interface ViewerInterface
{
    public function read(UserId $id): UserInterface;

    public function readAll(): UserListInterface;
}
