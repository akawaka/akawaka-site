<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaces;

use App\CMS\Application\Space\Gateway\FindSpaces\Middleware\ErrorHandlerMiddleware;
use App\CMS\Application\Space\Gateway\FindSpaces\Middleware\InstrumentationMiddleware;
use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use App\CMS\Application\Space\Gateway\FindSpaces\Middleware\ProcessorMiddleware;

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
