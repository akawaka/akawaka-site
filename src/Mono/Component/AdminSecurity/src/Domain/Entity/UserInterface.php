<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Primitive\EmailAddress\EmailAddress;
use Safe\DateTimeImmutable;

interface UserInterface
{
    public function getId(): UserId;

    public function getUsername(): string;

    public function getPassword(): string;

    public function getEmail(): EmailAddress;

    public function getRegistrationDate(): DateTimeImmutable;

    public function getLastUpdate(): ?DateTimeImmutable;

    public function getLastConnection(): ?DateTimeImmutable;
}
