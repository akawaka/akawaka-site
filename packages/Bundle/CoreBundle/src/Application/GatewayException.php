<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Application;

final class GatewayException extends \Exception
{
    public function __construct(
        string $identifier,
        string $serviceName,
        string $message
    ) {
        parent::__construct(
            \Safe\sprintf('Error during processing %s in %s: %s',
                $identifier,
                $serviceName,
                $message
            )
        );
    }
}
