<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Middleware;

use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Request;
use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace\Response;
use Mono\Bundle\AoBundle\Application\Space\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Infrastructure\Identity\SpaceIdentityGenerator;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private SpaceIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();

        $command = ($this->commandBus)(new Command(
            $identity,
            $request->getCode(),
            $request->getName(),
            $request->getTheme(),
        ));

        return new Response($identity, $command);
    }
}
