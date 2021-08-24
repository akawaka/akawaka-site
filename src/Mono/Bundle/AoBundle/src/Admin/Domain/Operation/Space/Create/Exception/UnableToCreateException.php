<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(
            \Safe\sprintf('Space was not created, reason: %s', $message)
        );
    }
}
