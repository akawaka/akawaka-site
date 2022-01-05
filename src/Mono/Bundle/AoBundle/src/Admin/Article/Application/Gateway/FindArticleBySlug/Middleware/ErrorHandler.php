<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleBySlug\Middleware;

use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleBySlug\Instrumentation;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class ErrorHandler
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
                'Error during find article by slug process',
                $exception->getFile(),
                $exception->getMessage(),
                $exception,
            );
        }
    }
}
