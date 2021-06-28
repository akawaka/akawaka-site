<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('Space was not created')
        );
    }
}
