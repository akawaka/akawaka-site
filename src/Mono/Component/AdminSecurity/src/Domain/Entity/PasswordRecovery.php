<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Identifier\PasswordRecoveryId;

abstract class PasswordRecovery implements PasswordRecoveryInterface
{
    protected string $id;

    protected UserInterface $user;

    protected string $token;

    protected \DateTimeImmutable $creationDate;

    public function __construct()
    {
        $this->creationDate = new \DateTimeImmutable();
    }

    public function getId(): PasswordRecoveryId
    {
        return new PasswordRecoveryId($this->id);
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return \Safe\DateTimeImmutable::createFromRegular($this->creationDate);
    }
}
