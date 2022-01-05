<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Application\Operation\Read\FindByUsernameOrEmail;

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
