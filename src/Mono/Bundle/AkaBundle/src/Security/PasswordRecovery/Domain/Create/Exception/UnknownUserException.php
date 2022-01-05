<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\Exception;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class UnknownUserException extends \Exception
{
    public function __construct(UserId $id)
    {
        parent::__construct(
            \Safe\sprintf('User with identifier %s is unknown', $id->getValue())
        );
    }
}
