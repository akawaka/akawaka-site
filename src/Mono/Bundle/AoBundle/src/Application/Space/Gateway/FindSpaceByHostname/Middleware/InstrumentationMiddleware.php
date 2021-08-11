<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceByHostname\Middleware;

use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceByHostname\Instrumentation;
use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class InstrumentationMiddleware
{
    public function __construct(
        private Instrumentation $instrumentation,
    ) {
    }

    public function __invoke(GatewayRequest $request, callable $next): GatewayResponse
    {
        $this->instrumentation->start($request);
        $response = ($next)($request);
        $this->instrumentation->success($response);

        return $response;
    }
}
