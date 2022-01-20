<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;

interface UpdaterInterface
{
    public function update(PasswordRecoveryInterface $passwordRecovery): void;
}
