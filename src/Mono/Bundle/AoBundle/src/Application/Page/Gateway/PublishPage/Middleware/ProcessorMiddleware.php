<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\PublishPage\Middleware;

use Mono\Bundle\AoBundle\Application\Page\Gateway\PublishPage\Request;
use Mono\Bundle\AoBundle\Application\Page\Gateway\PublishPage\Response;
use Mono\Bundle\AoBundle\Application\Page\Operation\Write\Publish\Command;
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
