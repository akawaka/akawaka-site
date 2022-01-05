<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

interface PasswordRecoveryInterface
{
    public function getId(): PasswordRecoveryId;

    public function getUser(): UserInterface;

    public function getToken(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
