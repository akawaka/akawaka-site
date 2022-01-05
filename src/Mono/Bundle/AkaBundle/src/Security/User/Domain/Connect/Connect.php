<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Domain\Connect;

use Mono\Bundle\AkaBundle\Security\User\Domain\Connect\DataPersister\ConnectPersisterInterface;
use Mono\Bundle\AkaBundle\Security\User\Domain\Connect\Exception\UnableToConnectException;
use Mono\Bundle\AkaBundle\Security\User\Domain\Connect\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Security\User\Domain\Connect\Exception\UnknownUserException;

final class Connect implements ConnectInterface
{
    public function __construct(
        private ConnectPersisterInterface $persister,
    ) {
    }

    public function __invoke(UserInterface $user): void
    {
        try {
            $this->persister->authenticate($user);
        } catch (UnknownUserException $exception) {
            throw new UnableToConnectException($user->getUsername()->getValue());
        }
    }
}
