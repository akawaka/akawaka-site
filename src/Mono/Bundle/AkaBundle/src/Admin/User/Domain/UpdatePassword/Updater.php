<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword;

use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\UpdatePasswordPersisterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;

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
