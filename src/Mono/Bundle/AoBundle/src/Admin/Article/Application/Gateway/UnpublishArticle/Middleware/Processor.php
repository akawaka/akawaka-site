<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Middleware;

use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Response;
use Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Write\Unpublish\Command;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle\Request;
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
