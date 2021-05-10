<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Read\FindUserByUsernameOrEmail;

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
