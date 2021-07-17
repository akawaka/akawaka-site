<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\UpdateArticle\Middleware;

use App\CMS\Application\Article\Gateway\UpdateArticle\Request;
use App\CMS\Application\Article\Gateway\UpdateArticle\Response;
use App\CMS\Application\Article\Operation\Write\Update\Command;
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
            $request->getSpaces(),
        )));
    }
}
