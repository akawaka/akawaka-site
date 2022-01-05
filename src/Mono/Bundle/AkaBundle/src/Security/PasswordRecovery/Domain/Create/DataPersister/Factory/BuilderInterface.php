<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

interface BuilderInterface
{
    public static function build(array $recovery = []): RecoveryInterface;
}
