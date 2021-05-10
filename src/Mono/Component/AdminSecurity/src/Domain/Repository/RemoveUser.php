<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;

interface RemoveUser
{
    public function remove(UserInterface $user): void;
}
