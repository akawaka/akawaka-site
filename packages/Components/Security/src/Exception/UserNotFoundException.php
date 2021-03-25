<?php

declare(strict_types=1);

namespace Black\Component\Security\Exception;

final class UserNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('User with id %s not found', $identifier)
        );
    }
}
