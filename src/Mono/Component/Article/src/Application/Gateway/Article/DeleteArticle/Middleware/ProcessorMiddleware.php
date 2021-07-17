<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Middleware;

use Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Request;
use Mono\Component\Article\Application\Gateway\Article\DeleteArticle\Response;
use Mono\Component\Article\Application\Operation\Article\Write\Delete\Command;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->commandBus)(new Command(
            $request->getIdentifier()
        )));
    }
}
