<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Exception;

final class UnknownStatusException extends \Exception
{
    public function __construct(string $status)
    {
        parent::__construct(
            \Safe\sprintf('Status %s is unknown', $status)
        );
    }
}
