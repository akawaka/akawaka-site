<?php

declare(strict_types=1);

namespace Mono\Component\Core\Application\Instrumentation;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

interface InstrumentationInterface
{
    public function start(GatewayRequest $request): void;

    public function success(GatewayResponse $response): void;

    public function error(GatewayRequest $request, string $reason): void;
}
