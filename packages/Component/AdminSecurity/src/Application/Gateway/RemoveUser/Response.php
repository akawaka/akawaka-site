<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\RemoveUser;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Symfony\Component\Security\Core\User\UserInterface;

final class Response implements GatewayResponse
{
    public function __construct(
        private UserInterface $user
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function data(): array
    {
        return [];
    }
}
