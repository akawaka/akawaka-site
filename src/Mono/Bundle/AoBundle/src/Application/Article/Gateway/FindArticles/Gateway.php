<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticles;

use Mono\Component\Article\Application\Gateway\Article\FindArticles\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Article\Application\Gateway\Article\FindArticles\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticles\Middleware\ProcessorMiddleware;
use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Component\Article\Application\Gateway\Article\FindArticles\Request;

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
