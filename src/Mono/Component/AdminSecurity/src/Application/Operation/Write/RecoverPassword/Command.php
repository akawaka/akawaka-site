<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\RecoverPassword;

final class Command
{
    public function __construct(
        private string $token
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
