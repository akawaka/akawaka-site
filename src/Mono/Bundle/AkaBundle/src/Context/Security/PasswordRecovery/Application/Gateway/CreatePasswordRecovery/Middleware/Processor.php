<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery\Middleware;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery\Request;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery\Response;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Operation\Write\CreatePasswordRecovery\Command;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Identity\PasswordRecoveryIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private PasswordRecoveryIdentityGenerator $generator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new Command(
            $this->generator->nextIdentity(),
            $request->getUsernameOrEmail(),
        ));

        return new Response();
    }
}
