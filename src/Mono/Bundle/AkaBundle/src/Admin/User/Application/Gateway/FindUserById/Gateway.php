<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUserById;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUserById\Middleware\ErrorHandler;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUserById\Middleware\Logger;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUserById\Middleware\Processor;
use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Gateway
{
    public function __construct(
        private ErrorHandler $errorHandler,
        private Logger $logger,
        private Processor $processor
    ) {
    }

    public function __invoke(GatewayRequest $request): GatewayResponse
    {
        return (new Pipe([
            $this->logger,
            $this->errorHandler,
            $this->processor,
        ]))($request);
    }
}
