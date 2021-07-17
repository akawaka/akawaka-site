<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\RemoveSpace\Middleware;

use App\CMS\Application\Space\Gateway\RemoveSpace\Instrumentation;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class ErrorHandlerMiddleware
{
    public function __construct(
        private Instrumentation $instrumentation,
    ) {
    }

    public function __invoke(GatewayRequest $request, callable $next): GatewayResponse
    {
        try {
            return ($next)($request);
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException(
                'Error during remove space process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
