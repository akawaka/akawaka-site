<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

interface CreatePersisterInterface
{
    public function create(RecoveryInterface $recovery): bool;
}
