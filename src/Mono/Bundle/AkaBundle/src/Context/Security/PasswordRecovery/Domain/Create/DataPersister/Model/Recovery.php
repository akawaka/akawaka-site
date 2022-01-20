<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

final class Recovery implements RecoveryInterface
{
    public function __construct(
        private PasswordRecoveryId $id,
        private string $usernameOrEmail,
    ) {
    }

    public function getId(): PasswordRecoveryId
    {
        return $this->id;
    }

    public function getUsernameOrEmail(): string
    {
        return $this->usernameOrEmail;
    }
}
