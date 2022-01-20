<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\CreateUser\Middleware;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\CreateUser\Request;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\CreateUser\Response;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Write\Create\Command;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Identity\UserIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private UserIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();

        ($this->commandBus)(new Command(
            $identity,
            $request->getUsername(),
            $request->getEmail(),
            $request->getPassword(),
        ));

        return new Response($identity);
    }
}
