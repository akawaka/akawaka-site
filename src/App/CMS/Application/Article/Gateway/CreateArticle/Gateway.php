<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\CreateArticle;

use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Middleware\ErrorHandlerMiddleware;
use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Middleware\InstrumentationMiddleware;
use App\CMS\Application\Article\Gateway\CreateArticle\Middleware\ProcessorMiddleware;
use Mono\Component\Core\Application\Gateway\Middleware\Pipe;
use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Response;

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
