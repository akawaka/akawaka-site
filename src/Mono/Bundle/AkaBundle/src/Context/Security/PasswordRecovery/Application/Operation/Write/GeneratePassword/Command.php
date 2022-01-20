<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Operation\Write\GeneratePassword;

final class Command
{
    public function __construct(
        private string $token,
        private string $password,
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
