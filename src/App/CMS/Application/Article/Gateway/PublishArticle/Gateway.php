<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\PublishArticle;

use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use App\CMS\Application\Article\Gateway\PublishArticle\Middleware\ErrorHandlerMiddleware;
use App\CMS\Application\Article\Gateway\PublishArticle\Middleware\InstrumentationMiddleware;
use App\CMS\Application\Article\Gateway\PublishArticle\Middleware\ProcessorMiddleware;

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
