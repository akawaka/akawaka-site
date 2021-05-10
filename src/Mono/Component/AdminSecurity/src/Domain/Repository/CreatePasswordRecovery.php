<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\PasswordRecoveryId;

interface CreatePasswordRecovery
{
    public function insert(PasswordRecoveryInterface $password): void;

    public function nextIdentity(): PasswordRecoveryId;
}
