<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\Exception;

final class UnknownUserException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('User with identifier %s is unknown', $identifier)
        );
    }
}
