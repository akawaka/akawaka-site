<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\Remove;

use Symfony\Component\Security\Core\User\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
