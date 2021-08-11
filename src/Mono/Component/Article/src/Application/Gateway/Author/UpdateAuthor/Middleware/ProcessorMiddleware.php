<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\UpdateAuthor\Middleware;

use Mono\Component\Article\Application\Gateway\Author\UpdateAuthor\Request;
use Mono\Component\Article\Application\Gateway\Author\UpdateAuthor\Response;
use Mono\Component\Article\Application\Operation\Author\Write\Update\Command;
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
            $request->getIdentifier(),
            $request->getName(),
            $request->getSlug(),
        )));
    }
}
