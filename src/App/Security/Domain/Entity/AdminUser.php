<?php

declare(strict_types=1);

namespace App\Security\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Enum\StatusEnum;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;
use Safe\DateTimeImmutable;
use Symfony\Component\Security\Core\User\UserInterface;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface as AdminUserInterface;

class AdminUser implements UserInterface, AdminUserInterface
{
    protected string $id;

    protected string $username;

    protected ?string $password;

    protected string $email;

    protected \DateTimeImmutable $registrationDate;

    protected ?\DateTimeImmutable $lastUpdate;

    protected ?\DateTimeImmutable $lastConnection;

    public function __construct()
    {
        $this->registrationDate = new \DateTimeImmutable();
        $this->lastUpdate = null;
        $this->lastConnection = null;
    }

    public static function create(
        UserId $id,
        Username $username,
        EmailAddress $emailAddress,
    ): self {
        $user = new self();
        $user->id = $id->getValue();
        $user->username = $username->getValue();
        $user->email = $emailAddress->getValue();

        return $user;
    }

    public function register(): void
    {
        $this->status = StatusEnum::REGISTERED;
        $this->lastUpdate = new \DateTimeImmutable();
    }

    public function connect(): void
    {
        $this->lastConnection = new \DateTimeImmutable();
    }

    public function updatePassword(string $password): void
    {
        $this->password = $password;
        $this->lastUpdate = new \DateTimeImmutable();
    }

    public function update(Username $username, EmailAddress $emailAddress): void
    {
        $this->username = $username->getValue();
        $this->email = $emailAddress->getValue();
        $this->lastUpdate = new \DateTimeImmutable();
    }

    public function getId(): UserId
    {
        return new UserId($this->id);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): EmailAddress
    {
        return new EmailAddress($this->email);
    }

    public function getRegistrationDate(): DateTimeImmutable
    {
        return \Safe\DateTimeImmutable::createFromRegular($this->registrationDate);
    }

    public function getLastUpdate(): ?DateTimeImmutable
    {
        if (null !== $this->lastUpdate) {
            return \Safe\DateTimeImmutable::createFromRegular($this->lastUpdate);
        }

        return null;
    }

    public function getLastConnection(): ?DateTimeImmutable
    {
        if (null !== $this->lastConnection) {
            return \Safe\DateTimeImmutable::createFromRegular($this->lastConnection);
        }

        return null;
    }

    public function getRoles(): array
    {
        return [
            'ROLE_ADMIN',
        ];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
    }
}
