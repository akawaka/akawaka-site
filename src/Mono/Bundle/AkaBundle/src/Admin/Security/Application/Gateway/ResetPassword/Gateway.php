<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword;

use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Middleware\ErrorHandler;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Middleware\Logger;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Middleware\Processor;
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
