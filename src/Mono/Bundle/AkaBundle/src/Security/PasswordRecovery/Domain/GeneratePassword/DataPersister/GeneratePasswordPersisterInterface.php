<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;

interface GeneratePasswordPersisterInterface
{
    public function recover(PasswordRecoveryInterface $passwordRecovery): bool;
}
