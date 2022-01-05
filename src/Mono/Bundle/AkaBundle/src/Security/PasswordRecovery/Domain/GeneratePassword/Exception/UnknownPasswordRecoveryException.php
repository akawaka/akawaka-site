<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\Exception;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

final class UnknownPasswordRecoveryException extends \Exception
{
    public function __construct(PasswordRecoveryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Password Recovery with identifier %s is unknown', $id->getValue())
        );
    }
}
