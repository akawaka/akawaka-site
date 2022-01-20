<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

interface CreatePersisterInterface
{
    public function create(RecoveryInterface $recovery): bool;
}
