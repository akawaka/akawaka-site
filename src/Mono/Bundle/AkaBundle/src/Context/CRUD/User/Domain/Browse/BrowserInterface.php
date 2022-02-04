<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserListInterface;

interface BrowserInterface
{
    public function browse(): UserListInterface;
}
