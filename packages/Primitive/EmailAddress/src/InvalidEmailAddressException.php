<?php

declare(strict_types=1);

namespace Black\Primitive\EmailAddress;

final class InvalidEmailAddressException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(
            \Safe\sprintf('Email %s is not a valid email address', $email)
        );
    }
}
