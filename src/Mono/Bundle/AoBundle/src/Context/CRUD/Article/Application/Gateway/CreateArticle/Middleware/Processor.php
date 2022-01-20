<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\CreateArticle\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\CreateArticle\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\CreateArticle\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Identity\ArticleIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private ArticleIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();
        ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
            $request->getCategories(),
            $request->getAuthors(),
            $request->getSpaces(),
        ));

        return new Response($identity);
    }
}
