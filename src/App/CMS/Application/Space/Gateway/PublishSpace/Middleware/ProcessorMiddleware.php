<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\PublishSpace\Middleware;

use App\CMS\Application\Space\Gateway\PublishSpace\Request;
use App\CMS\Application\Space\Gateway\PublishSpace\Response;
use App\CMS\Application\Space\Operation\Write\Publish\Command;
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
