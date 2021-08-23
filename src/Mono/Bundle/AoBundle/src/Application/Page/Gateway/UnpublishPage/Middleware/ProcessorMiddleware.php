<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Middleware;

use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Request;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage\Response;
use Mono\Bundle\AoBundle\Application\Page\Operation\Write\Unpublish\Command;
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
