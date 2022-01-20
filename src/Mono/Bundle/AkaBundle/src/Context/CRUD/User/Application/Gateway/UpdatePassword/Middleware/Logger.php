<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdatePassword\Middleware;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser\Instrumentation;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Logger
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
