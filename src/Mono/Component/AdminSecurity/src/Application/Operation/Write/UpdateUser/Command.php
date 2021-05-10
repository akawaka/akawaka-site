<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\UpdateUser;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $username,
        private string $email,
    ) {
    }

    public function getId(): UserId
    {
        return new UserId($this->identifier);
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
