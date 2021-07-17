<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\UpdateSpace\Middleware;

use App\CMS\Application\Space\Gateway\UpdateSpace\Instrumentation;
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
