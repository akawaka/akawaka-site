<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

interface ViewerInterface
{
    public function findById(PasswordRecoveryId $id): RecoveryInterface;

    public function findByToken(string $token): RecoveryInterface;
}
