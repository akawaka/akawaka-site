<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\Update;

use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;
use Symfony\Component\Security\Core\User\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user,
        private string $username,
        private string $email,
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getUsername(): Username
    {
        return new Username($this->username);
    }

    public function getEmail(): EmailAddress
    {
        return new EmailAddress($this->email);
    }
}
