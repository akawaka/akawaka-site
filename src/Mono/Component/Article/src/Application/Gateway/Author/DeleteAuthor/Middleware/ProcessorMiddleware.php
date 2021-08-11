<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\DeleteAuthor\Middleware;

use Mono\Component\Article\Application\Gateway\Author\DeleteAuthor\Request;
use Mono\Component\Article\Application\Gateway\Author\DeleteAuthor\Response;
use Mono\Component\Article\Application\Operation\Author\Write\Delete\Command;
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
