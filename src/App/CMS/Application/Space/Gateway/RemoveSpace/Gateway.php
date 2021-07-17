<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\RemoveSpace;

use App\CMS\Application\Space\Gateway\RemoveSpace\Middleware\ErrorHandlerMiddleware;
use App\CMS\Application\Space\Gateway\RemoveSpace\Middleware\InstrumentationMiddleware;
use App\CMS\Application\Space\Gateway\RemoveSpace\Middleware\ProcessorMiddleware;
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
