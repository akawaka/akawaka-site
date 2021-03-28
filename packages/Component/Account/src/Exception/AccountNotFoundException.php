<?php

declare(strict_types=1);

namespace Black\Component\Account\Exception;

final class AccountNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Account with id %s not found', $identifier)
        );
    }
}
