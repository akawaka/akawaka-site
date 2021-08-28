<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\PublishSpace\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\PublishSpace\Request;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\PublishSpace\Response;
use Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Publish\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
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
