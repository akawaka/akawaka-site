<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdatePassword\Middleware;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdatePassword\Request;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdatePassword\Response;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\UpdatePassword;

final class Processor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new UpdatePassword\Command(
            $request->getIdentifier(),
            $request->getPassword(),
        ));

        return new Response();
    }
}
