<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Symfony\Component\Security\Core\User\UserInterface;

interface FindById
{
    public function find(UserId $id): ?UserInterface;
}
