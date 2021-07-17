<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\CreateSpace\Middleware;

use App\CMS\Application\Space\Gateway\CreateSpace\Request;
use App\CMS\Application\Space\Gateway\CreateSpace\Response;
use App\CMS\Application\Space\Operation\Write\Create\Command;
use App\CMS\Infrastructure\Identity\SpaceIdentityGenerator;
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
