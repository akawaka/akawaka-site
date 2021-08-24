<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\UpdateCategory\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\UpdateCategory\Request;
use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\UpdateCategory\Response;
use Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Write\Update\Command;
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
            $request->getIdentifier(),
            $request->getName(),
            $request->getSlug(),
        )));
    }
}
