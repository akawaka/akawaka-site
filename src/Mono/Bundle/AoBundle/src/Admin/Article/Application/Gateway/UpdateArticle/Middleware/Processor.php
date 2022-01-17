<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UpdateArticle\Middleware;

use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UpdateArticle\Response;
use Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Write\Update\Command;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UpdateArticle\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
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
            $request->getAuthors(),
            $request->getSpaces(),
        )));
    }
}
