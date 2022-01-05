<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model;

final class PasswordRecovery implements PasswordRecoveryInterface
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
