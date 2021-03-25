<?php

declare(strict_types=1);

namespace Black\Component\Account\Exception;

final class DuplicateAccountException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(
            \Safe\sprintf('An account with email %s already found', $email)
        );
    }
}
