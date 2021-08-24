<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Middleware\ProcessorMiddleware;
use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;

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
