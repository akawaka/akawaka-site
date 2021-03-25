<?php

declare(strict_types=1);

namespace Black\Component\Security\Exception;

final class AlreadyActivatedException extends \Exception
{
    public function __construct(string $username)
    {
        parent::__construct(
            \Safe\sprintf('User %s is already activated', $username)
        );
    }
}
