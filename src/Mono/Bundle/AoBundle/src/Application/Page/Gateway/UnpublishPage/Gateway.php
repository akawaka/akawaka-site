<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage;

use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Middleware\ProcessorMiddleware;

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
