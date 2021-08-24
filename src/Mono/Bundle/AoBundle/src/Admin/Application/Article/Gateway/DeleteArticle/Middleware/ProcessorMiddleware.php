<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\DeleteArticle\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\DeleteArticle\Request;
use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\DeleteArticle\Response;
use Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Delete\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
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
