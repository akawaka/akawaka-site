<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

interface ViewProviderInterface
{
    public function getById(PasswordRecoveryId $id): ?RecoveryInterface;

    public function getByToken(string $token): ?RecoveryInterface;
}
