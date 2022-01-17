<?php

declare(strict_types=1);

namespace App\Contact\Application\Gateway\SendContact\Middleware;

use App\Contact\Application\Gateway\SendContact\Request;
use App\Contact\Application\Gateway\SendContact\Response;
use App\Contact\Application\Operation\Write\Send\Command;
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
            $request->getFirstname(),
            $request->getLastname(),
            $request->getEmail(),
            $request->getPhone(),
            $request->getMessage(),
            $request->getBudget(),
            $request->getHow(),
        ));

        return new Response();
    }
}
