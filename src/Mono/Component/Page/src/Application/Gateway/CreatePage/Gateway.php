<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\CreatePage;

use Mono\Component\Page\Application\Gateway\CreatePage\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Page\Application\Gateway\CreatePage\Middleware\InstrumentationMiddleware;
use Mono\Component\Page\Application\Gateway\CreatePage\Middleware\ProcessorMiddleware;
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
