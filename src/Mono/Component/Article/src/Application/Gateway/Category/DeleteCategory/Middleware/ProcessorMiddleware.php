<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Middleware;

use Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Request;
use Mono\Component\Article\Application\Gateway\Category\DeleteCategory\Response;
use Mono\Component\Article\Application\Operation\Category\Write\Delete\Command;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new Command(
            $request->getIdentifier()
        ));

        return new Response();
    }
}
