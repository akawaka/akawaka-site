<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\DeleteCategory;

use Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Middleware\InstrumentationMiddleware;
use Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Middleware\ProcessorMiddleware;
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
