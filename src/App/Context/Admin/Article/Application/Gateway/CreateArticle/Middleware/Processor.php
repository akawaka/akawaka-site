<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\CreateArticle\Middleware;

use App\Context\Admin\Article\Application\Gateway\CreateArticle\Request;
use App\Context\Admin\Article\Application\Gateway\CreateArticle\Response;
use App\Context\Admin\Article\Application\Operation\Write\Create\Command;
use App\Shared\Infrastructure\Identity\ArticleIdentityGenerator;
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
