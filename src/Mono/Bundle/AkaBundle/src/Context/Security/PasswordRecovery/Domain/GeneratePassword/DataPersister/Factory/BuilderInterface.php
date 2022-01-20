<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;

interface BuilderInterface
{
    public static function build(array $passwordRecovery = []): PasswordRecoveryInterface;
}
