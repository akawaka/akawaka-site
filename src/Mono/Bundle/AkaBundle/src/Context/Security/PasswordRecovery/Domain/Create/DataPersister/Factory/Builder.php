<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model\Recovery;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $recovery = []): RecoveryInterface
    {
        return new Recovery(
            $recovery['id'],
            $recovery['usernameOrEmail'],
        );
    }
}
