<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\DeleteArticle;

use App\Context\Admin\Article\Application\Gateway\DeleteArticle\Middleware\ErrorHandler;
use App\Context\Admin\Article\Application\Gateway\DeleteArticle\Middleware\Logger;
use App\Context\Admin\Article\Application\Gateway\DeleteArticle\Middleware\Processor;
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
