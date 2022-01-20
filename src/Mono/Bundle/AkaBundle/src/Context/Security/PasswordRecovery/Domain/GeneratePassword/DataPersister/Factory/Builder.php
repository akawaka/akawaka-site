<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecovery;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $passwordRecovery = []): PasswordRecoveryInterface
    {
        return new PasswordRecovery(
            $passwordRecovery['token'],
            $passwordRecovery['password'],
        );
    }
}
