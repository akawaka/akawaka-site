<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\ResetPassword;

use App\Security\Domain\Entity\AdminUser;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user,
    ) {
    }

    public function getUser(): AdminUser
    {
        return $this->user;
    }
}
