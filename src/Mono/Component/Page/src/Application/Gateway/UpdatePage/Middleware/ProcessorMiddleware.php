<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\UpdatePage\Middleware;

use Mono\Component\Page\Application\Gateway\UpdatePage\Request;
use Mono\Component\Page\Application\Gateway\UpdatePage\Response;
use Mono\Component\Page\Application\Operation\Write\Update\Command;
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
        )));
    }
}
