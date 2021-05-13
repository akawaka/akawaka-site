<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Operation\Write\ResetPassword;

use Mono\Component\AdminSecurity\Domain\Entity\User;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
