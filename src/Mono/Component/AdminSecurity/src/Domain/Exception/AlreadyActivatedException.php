<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Exception;

final class AlreadyActivatedException extends \Exception
{
    public function __construct(string $username)
    {
        parent::__construct(
            \Safe\sprintf('User with identifier %s is already activated', $username)
        );
    }
}