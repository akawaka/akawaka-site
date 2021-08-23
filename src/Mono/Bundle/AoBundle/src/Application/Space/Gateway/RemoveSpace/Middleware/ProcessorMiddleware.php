<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\RemoveSpace\Middleware;

use Mono\Bundle\AoBundle\Application\Space\Gateway\RemoveSpace\Request;
use Mono\Bundle\AoBundle\Application\Space\Gateway\RemoveSpace\Response;
use Mono\Bundle\AoBundle\Application\Space\Operation\Write\Remove\Command;
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
