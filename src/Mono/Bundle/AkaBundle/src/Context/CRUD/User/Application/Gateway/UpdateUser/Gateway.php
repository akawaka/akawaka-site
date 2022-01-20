<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser\Middleware\ErrorHandler;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser\Middleware\Logger;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser\Middleware\Processor;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\Middleware\Pipe;

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
