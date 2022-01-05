<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\Exception\UnableToCreateRecoveryPasswordException;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister,
    ) {
    }

    public function create(RecoveryInterface $recovery): void
    {
        try {
            $this->persister->create($recovery);
        } catch (\Exception $exception) {
            throw new UnableToCreateRecoveryPasswordException($recovery->getId()->getValue());
        }
    }
}
