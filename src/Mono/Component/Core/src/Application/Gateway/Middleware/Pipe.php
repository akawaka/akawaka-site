<?php

declare(strict_types=1);

namespace Mono\Component\Core\Application\Gateway\Middleware;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

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
