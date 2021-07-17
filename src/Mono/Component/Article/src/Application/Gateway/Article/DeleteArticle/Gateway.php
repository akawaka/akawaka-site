<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\DeleteArticle;

use Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Middleware\InstrumentationMiddleware;
use Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Middleware\ProcessorMiddleware;
use Mono\Component\Core\Application\Gateway\Middleware\Pipe;

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
