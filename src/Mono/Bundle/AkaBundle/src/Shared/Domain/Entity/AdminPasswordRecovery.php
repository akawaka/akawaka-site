<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Entity;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Ramsey\Uuid\Uuid;

class AdminPasswordRecovery implements PasswordRecoveryInterface
{
    protected string $id;

    protected UserInterface $user;

    protected string $token;

    protected \DateTimeImmutable $creationDate;

    public function __construct()
    {
        $this->creationDate = new \DateTimeImmutable();
    }

    public static function create(
        PasswordRecoveryId $id,
        UserInterface $user,
    ): PasswordRecoveryInterface {
        $recovery = new self();
        $recovery->id = $id->getValue();
        $recovery->user = $user;
        $recovery->token = Uuid::uuid6()->toString();

        return $recovery;
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
