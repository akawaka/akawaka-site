<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Middleware;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Response;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Operation\Write\GeneratePassword;

final class Processor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new GeneratePassword\Command(
            $request->getToken(),
            $request->getPassword(),
        ));

        return new Response();
    }
}
