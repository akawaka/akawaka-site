<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(
            \Safe\sprintf('Page was not created, reason: %s', $message)
        );
    }
}
