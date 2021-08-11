<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageBySlug;

use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Component\Page\Application\Gateway\FindPageBySlug\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Page\Application\Gateway\FindPageBySlug\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageBySlug\Middleware\ProcessorMiddleware;
use Mono\Component\Page\Application\Gateway\FindPageBySlug\Request;

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
