<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Instrumentation;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

interface InstrumentationInterface
{
    public function start(GatewayRequest $request): void;

    public function success(GatewayResponse $response): void;

    public function error(GatewayRequest $request, string $reason): void;
}
