<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\PublishArticle\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\PublishArticle\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\PublishArticle\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Write\Publish\Command;
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
            $request->getIdentifier()
        )));
    }
}
