<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model;

interface PasswordRecoveryInterface
{
    public function getToken(): string;

    public function getPassword(): string;
}
