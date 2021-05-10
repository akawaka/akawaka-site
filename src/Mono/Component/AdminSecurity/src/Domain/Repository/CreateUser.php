<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;

interface CreateUser
{
    public function insert(UserInterface $user): void;

    public function nextIdentity(): UserId;
}
