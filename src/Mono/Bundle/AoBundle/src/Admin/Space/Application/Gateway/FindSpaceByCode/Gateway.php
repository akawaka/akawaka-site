<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByCode;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByCode\Middleware\ErrorHandler;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByCode\Middleware\Logger;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByCode\Middleware\Processor;
use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;

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
