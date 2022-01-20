<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\Exception;

final class UnableToCreateRecoveryPasswordException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('User %s failed during authentication process', $id)
        );
    }
}
