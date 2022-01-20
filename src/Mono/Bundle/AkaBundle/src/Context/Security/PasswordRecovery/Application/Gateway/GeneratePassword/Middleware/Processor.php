<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Middleware;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Request;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Response;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Operation\Write\GeneratePassword\Command;
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
            $request->getToken(),
            $request->getPassword(),
        ));

        return new Response();
    }
}
