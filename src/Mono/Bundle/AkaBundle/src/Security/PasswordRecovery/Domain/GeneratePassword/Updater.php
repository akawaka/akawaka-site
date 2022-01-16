<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\GeneratePasswordPersisterInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private GeneratePasswordPersisterInterface $persister,
    ) {
    }

    public function update(PasswordRecoveryInterface $passwordRecovery): void
    {
        try {
            $this->persister->recover($passwordRecovery);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($passwordRecovery->getToken(), $exception->getCode(), $exception);
        }
    }
}
