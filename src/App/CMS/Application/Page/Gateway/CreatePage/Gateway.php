<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\CreatePage;

use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Component\Page\Application\Gateway\CreatePage\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Page\Application\Gateway\CreatePage\Middleware\InstrumentationMiddleware;
use App\CMS\Application\Page\Gateway\CreatePage\Middleware\ProcessorMiddleware;
use Mono\Component\Page\Application\Gateway\CreatePage\Response;

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
