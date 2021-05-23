<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Read\FindUserByUsernameOrEmail;

final class Query
{
    public function __construct(
        private string $usernameOrEmail
    ) {
    }

    public function getUsernameOrEmail(): string
    {
        return $this->usernameOrEmail;
    }
}
