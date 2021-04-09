<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Symfony\Component\Security\Core\User\UserInterface;

interface Update
{
    public function update(UserInterface $user): void;
}
