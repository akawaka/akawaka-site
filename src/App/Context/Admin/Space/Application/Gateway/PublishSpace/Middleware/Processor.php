<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\PublishSpace\Middleware;

use App\Context\Admin\Space\Application\Gateway\PublishSpace\Request;
use App\Context\Admin\Space\Application\Gateway\PublishSpace\Response;
use App\Context\Admin\Space\Application\Operation\Write\Publish\Command;
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
