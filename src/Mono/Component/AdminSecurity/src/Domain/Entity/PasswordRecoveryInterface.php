<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Identifier\PasswordRecoveryId;

interface PasswordRecoveryInterface
{
    public function getId(): PasswordRecoveryId;

    public function getUser(): UserInterface;

    public function getToken(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
