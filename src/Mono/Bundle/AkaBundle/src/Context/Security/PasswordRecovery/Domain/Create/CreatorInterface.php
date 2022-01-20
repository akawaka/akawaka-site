<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

interface CreatorInterface
{
    public function create(RecoveryInterface $recovery): void;
}
