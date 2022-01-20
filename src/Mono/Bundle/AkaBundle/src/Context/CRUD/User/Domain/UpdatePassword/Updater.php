<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\UpdatePasswordPersisterInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\Exception\UnableToUpdateException;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePasswordPersisterInterface $persister,
    ) {
    }

    public function update(UserInterface $user): void
    {
        try {
            $this->persister->update($user);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($user->getId()->getValue());
        }
    }
}
