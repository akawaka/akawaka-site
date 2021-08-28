<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\DeleteUser\Middleware;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\DeleteUser\Request;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\DeleteUser\Response;
use Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\Delete\Command;
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
