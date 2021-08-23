<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\PublishSpace\Middleware;

use Mono\Bundle\AoBundle\Application\Space\Gateway\PublishSpace\Request;
use Mono\Bundle\AoBundle\Application\Space\Gateway\PublishSpace\Response;
use Mono\Bundle\AoBundle\Application\Space\Operation\Write\Publish\Command;
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
            $request->getIdentifier()
        )));
    }
}
