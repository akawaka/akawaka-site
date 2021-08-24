<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\UnpublishArticle\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\UnpublishArticle\Request;
use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\UnpublishArticle\Response;
use Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Unpublish\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
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
