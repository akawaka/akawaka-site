<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class Recovery implements RecoveryInterface
{
    public function __construct(
        private PasswordRecoveryId $id,
        private string $token,
        private UserInterface $user,
        private \DateTimeImmutable $creationDate,
    ) {
    }

    public function getId(): PasswordRecoveryId
    {
        return $this->id;
    }

    public function getUsername(): Username
    {
        return $this->user->getUsername();
    }

    public function getEmail(): EmailAddress
    {
        return $this->user->getEmail();
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreationDate(): \DateTimeImmutable
    {
        return $this->creationDate;
    }
}
