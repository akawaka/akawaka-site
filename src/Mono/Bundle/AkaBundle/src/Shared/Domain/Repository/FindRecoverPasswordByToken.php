<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Repository;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;

interface FindRecoverPasswordByToken
{
    public function find(string $token): ?PasswordRecoveryInterface;
}
