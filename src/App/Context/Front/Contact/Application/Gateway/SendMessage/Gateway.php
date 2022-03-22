<?php

declare(strict_types=1);

namespace App\Context\Front\Contact\Application\Gateway\SendMessage;

use App\Context\Front\Contact\Application\Gateway\SendMessage\Middleware\ErrorHandler;
use App\Context\Front\Contact\Application\Gateway\SendMessage\Middleware\Logger;
use App\Context\Front\Contact\Application\Gateway\SendMessage\Middleware\Processor;
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
