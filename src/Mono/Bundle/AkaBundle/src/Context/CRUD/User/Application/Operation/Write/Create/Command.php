<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Write\Create;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class Command
{
    public function __construct(
        private UserId $id,
        private string $username,
        private string $email,
        private string $password,
    ) {
    }

    public function getId(): UserId
    {
        return $this->id;
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
