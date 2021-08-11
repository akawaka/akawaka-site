<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\DeleteAuthor\Middleware;

use Mono\Component\Article\Application\Gateway\Author\DeleteAuthor\Instrumentation;
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
                'Error during delete author process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
