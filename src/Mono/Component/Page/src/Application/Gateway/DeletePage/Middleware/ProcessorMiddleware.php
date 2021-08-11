<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\DeletePage\Middleware;

use Mono\Component\Page\Application\Gateway\DeletePage\Request;
use Mono\Component\Page\Application\Gateway\DeletePage\Response;
use Mono\Component\Page\Application\Operation\Write\Delete\Command;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

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
