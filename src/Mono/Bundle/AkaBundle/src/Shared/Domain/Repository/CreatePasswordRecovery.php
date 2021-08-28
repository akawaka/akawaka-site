<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Repository;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

interface CreatePasswordRecovery
{
    public function insert(PasswordRecoveryInterface $password): void;

    public function nextIdentity(): PasswordRecoveryId;
}
