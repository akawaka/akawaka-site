<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Symfony\Component\Security\Core\User\UserInterface;

interface Create
{
    public function insert(UserInterface $user): void;

    public function nextIdentity(): UserId;
}
