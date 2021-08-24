<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway\Middleware;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Pipe
{
    public function __construct(
        private array $middlewares = [],
    ) {
    }

    public function __invoke(GatewayRequest $request, ?callable $next = null): GatewayResponse
    {
        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function ($request) use ($middleware, $next) {
                return $middleware($request, $next);
            };
        }

        return $next($request);
    }
}
