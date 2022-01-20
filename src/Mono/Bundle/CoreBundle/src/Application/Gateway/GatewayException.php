<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

final class GatewayException extends \Exception
{
    public function __construct(
        string $message,
        \Exception $previous,
    ) {
        parent::__construct(
            message: \Safe\sprintf(
                '%s in %s: %s',
                $message,
                $previous->getFile(),
                $previous->getMessage(),
            ),
            previous: $previous
        );
    }
}
