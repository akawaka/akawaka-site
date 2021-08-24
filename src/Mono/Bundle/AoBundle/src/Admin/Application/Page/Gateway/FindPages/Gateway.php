<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages;

use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Middleware\ErrorHandlerMiddleware;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Middleware\InstrumentationMiddleware;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Middleware\ProcessorMiddleware;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Request;

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
