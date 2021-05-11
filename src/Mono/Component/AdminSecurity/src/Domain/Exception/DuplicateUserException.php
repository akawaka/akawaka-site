<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Exception;

final class DuplicateUserException extends \Exception
{
    public function __construct(string $username)
    {
        parent::__construct(
            \Safe\sprintf('An user with username %s already found', $username)
        );
    }
}