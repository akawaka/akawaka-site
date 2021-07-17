<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\UpdateArticle\Middleware;

use Mono\Component\Article\Application\Gateway\Article\UpdateArticle\Request;
use Mono\Component\Article\Application\Gateway\Article\UpdateArticle\Response;
use Mono\Component\Article\Application\Operation\Article\Write\Update\Command;
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
            $request->getContent(),
            $request->getCategories(),
        )));
    }
}
