<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace;

use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Middleware\ProcessorMiddleware;
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
