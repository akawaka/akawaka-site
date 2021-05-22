<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\Register;

use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class Command
{
    public function __construct(
        private string $username,
        private string $email,
        private string $password,
    ) {
    }

    public function getUsername(): Username
    {
        return new Username($this->username);
    }

    public function getEmail(): EmailAddress
    {
        return new EmailAddress($this->email);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
