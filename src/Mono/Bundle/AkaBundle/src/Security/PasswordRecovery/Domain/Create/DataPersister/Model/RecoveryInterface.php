<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

interface RecoveryInterface
{
    public function getId(): PasswordRecoveryId;

    public function getUsernameOrEmail(): string;
}
