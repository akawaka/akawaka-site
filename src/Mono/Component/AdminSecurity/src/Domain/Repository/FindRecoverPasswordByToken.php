<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;

interface FindRecoverPasswordByToken
{
    public function find(string $token): ?PasswordRecoveryInterface;
}
