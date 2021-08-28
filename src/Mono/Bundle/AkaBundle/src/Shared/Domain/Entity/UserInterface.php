<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Entity;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
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
