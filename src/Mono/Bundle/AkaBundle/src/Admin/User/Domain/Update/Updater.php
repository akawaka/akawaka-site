<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\DataPersister\Model\UserInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
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
