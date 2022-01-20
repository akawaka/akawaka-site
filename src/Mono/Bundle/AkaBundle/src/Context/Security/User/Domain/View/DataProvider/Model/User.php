<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\View\DataProvider\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class User implements UserInterface
{
    public function __construct(
        private UserId $id,
        private Username $username,
        private EmailAddress $email,
        private string $password,
        private \DateTimeImmutable $registrationDate,
        private ?\DateTimeImmutable $lastUpdate,
        private ?\DateTimeImmutable $lastConnection,
    ) {
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getUsername(): Username
    {
        return $this->username;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRegistrationDate(): \DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function getLastUpdate(): ?\DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    public function getLastConnection(): ?\DateTimeImmutable
    {
        return $this->lastConnection;
    }
}
