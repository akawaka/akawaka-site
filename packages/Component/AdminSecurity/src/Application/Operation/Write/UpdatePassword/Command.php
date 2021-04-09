<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\UpdatePassword;

use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;
use Symfony\Component\Security\Core\User\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user,
        private string $password,
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
