<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister;

use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception\UnableToConnectException;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception\UnknownUserException;

interface ConnectPersisterInterface
{
    /**
     * @throws UnknownUserException
     * @throws UnableToConnectException
     */
    public function authenticate(UserInterface $user): bool;
}
