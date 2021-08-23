<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaces;

use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaces\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaces\Middleware\InstrumentationMiddleware;
use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaces\Middleware\ProcessorMiddleware;

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
