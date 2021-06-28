<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View\Exception;

final class UnknownSpaceException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s is unknown', $identifier)
        );
    }
}
