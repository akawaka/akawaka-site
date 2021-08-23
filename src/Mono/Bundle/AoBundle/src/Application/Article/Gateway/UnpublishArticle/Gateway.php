<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\UnpublishArticle;

use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\AoBundle\Application\Article\Gateway\UnpublishArticle\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Application\Article\Gateway\UnpublishArticle\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Application\Article\Gateway\UnpublishArticle\Middleware\ProcessorMiddleware;

final class Gateway
{
    public function __construct(
        private ErrorHandlerMiddleware $errorHandlerMiddleware,
        private InstrumentationMiddleware $instrumentationMiddleware,
        private ProcessorMiddleware $processorMiddleware
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return (new Pipe([
            $this->instrumentationMiddleware,
            $this->errorHandlerMiddleware,
            $this->processorMiddleware,
        ]))($request);
    }
}
