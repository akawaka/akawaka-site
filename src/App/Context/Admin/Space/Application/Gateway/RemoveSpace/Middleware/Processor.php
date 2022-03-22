<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\RemoveSpace\Middleware;

use App\Context\Admin\Space\Application\Gateway\RemoveSpace\Request;
use App\Context\Admin\Space\Application\Gateway\RemoveSpace\Response;
use App\Context\Admin\Space\Application\Operation\Write\Remove\Command;
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
