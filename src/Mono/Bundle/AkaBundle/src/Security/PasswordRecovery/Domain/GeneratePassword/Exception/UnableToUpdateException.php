<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\GeneratePassword\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('PasswordRecovery %s failed during Update process', $id)
        );
    }
}
