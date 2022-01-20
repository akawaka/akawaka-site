<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\DeleteArticle\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\DeleteArticle\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\DeleteArticle\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Write\Delete\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
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
