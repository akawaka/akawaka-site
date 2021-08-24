<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\DeleteCategory\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\DeleteCategory\Request;
use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\DeleteCategory\Response;
use Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Write\Delete\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

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
