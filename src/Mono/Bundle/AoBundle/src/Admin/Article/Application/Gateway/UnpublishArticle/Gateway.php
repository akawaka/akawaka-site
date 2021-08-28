<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle;

use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Middleware\ErrorHandler;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Middleware\Logger;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Middleware\Processor;

final class Gateway
{
    public function __construct(
        private ErrorHandler $errorHandler,
        private Logger $logger,
        private Processor $processor
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return (new Pipe([
            $this->logger,
            $this->errorHandler,
            $this->processor,
        ]))($request);
    }
}
