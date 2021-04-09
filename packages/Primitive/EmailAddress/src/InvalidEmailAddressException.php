<?php

declare(strict_types=1);

namespace Mono\Primitive\EmailAddress;

final class InvalidEmailAddressException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Email address %s is not valid', $identifier)
        );
    }
}
