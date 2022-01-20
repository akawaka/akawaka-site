<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class UnknownUserException extends \Exception
{
    public function __construct(Username $username)
    {
        parent::__construct(
            \Safe\sprintf('User with username %s is unknown', $username->getValue())
        );
    }
}
