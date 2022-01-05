<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Domain\Connect\Exception;

final class UnableToConnectException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('User %s failed during connection process', $id)
        );
    }
}
