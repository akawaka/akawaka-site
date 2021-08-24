<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

final class GatewayException extends \Exception
{
    public function __construct(
        string $identifier,
        string $serviceName,
        string $message
    ) {
        parent::__construct(
            \Safe\sprintf(
                '%s in %s: %s',
                $identifier,
                $serviceName,
                $message
            )
        );
    }
}
