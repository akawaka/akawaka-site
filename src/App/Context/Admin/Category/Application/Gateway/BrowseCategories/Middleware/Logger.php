<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\BrowseCategories\Middleware;

use App\Context\Admin\Category\Application\Gateway\BrowseCategories\Instrumentation;
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
