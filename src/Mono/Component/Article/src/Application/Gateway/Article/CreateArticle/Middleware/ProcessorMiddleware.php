<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\CreateArticle\Middleware;

use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Request;
use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Response;
use Mono\Component\Article\Application\Operation\Article\Write\Create\Command;
use Mono\Component\Article\Infrastructure\Identity\ArticleIdentityGenerator;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private ArticleIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();
        $command = ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
            $request->getCategories(),
        ));

        return new Response($identity, $command);
    }
}
