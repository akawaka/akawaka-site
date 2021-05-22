<?php

declare(strict_types=1);

namespace App\Security\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecovery as BasePasswordRecovery;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\PasswordRecoveryId;
use Ramsey\Uuid\Uuid;

class AdminPasswordRecovery extends BasePasswordRecovery
{
    public static function create(
        PasswordRecoveryId $id,
        UserInterface $user,
    ): PasswordRecoveryInterface {
        $recovery = new self();
        $recovery->id = $id->getValue();
        $recovery->user = $user;
        $recovery->token = Uuid::uuid6()->toString();

        return $recovery;
    }
}
