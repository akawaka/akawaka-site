<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Symfony\Component\Security\Core\User\UserInterface;

interface Remove
{
    public function remove(UserInterface $user): void;
}
