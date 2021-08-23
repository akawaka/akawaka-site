<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(
            \Safe\sprintf('Page was not created, reason: %s', $message)
        );
    }
}
