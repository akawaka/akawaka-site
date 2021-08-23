<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\CreateArticle\Middleware;

use Mono\Bundle\AoBundle\Application\Article\Gateway\CreateArticle\Request;
use Mono\Component\Article\Application\Gateway\Article\CreateArticle\Response;
use Mono\Bundle\AoBundle\Application\Article\Operation\Write\Create\Command;
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
            $request->getAuthors(),
            $request->getSpaces(),
        ));

        return new Response($identity, $command);
    }
}
