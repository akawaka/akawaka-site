<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\Exception;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class AlreadyExistingUserException extends \Exception
{
    public function __construct(UserId $id)
    {
        parent::__construct(
            \Safe\sprintf('User with identifier %s already exist', $id->getValue())
        );
    }
}
