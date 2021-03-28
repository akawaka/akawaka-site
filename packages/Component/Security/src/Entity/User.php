<?php

declare(strict_types=1);

namespace Black\Component\Security\Entity;

use Safe\DateTimeImmutable;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    protected string $username;

    protected string $password;

    protected string $email;

    protected bool $active;

    protected bool $locked;

    protected \DateTimeImmutable $dateRegistered;

    protected ?\DateTimeImmutable $dateUpdated;

    protected ?\DateTimeImmutable $lastConnection;

    public function __construct()
    {
        $this->active = false;
        $this->locked = false;
        $this->dateRegistered = new DateTimeImmutable();
        $this->dateUpdated = null;
        $this->lastConnection = null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function getDateRegistered(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->dateRegistered);
    }

    public function getDateUpdated(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->dateUpdated);
    }

    public function getLastConnection(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->lastConnection);
    }

    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
    }
}
