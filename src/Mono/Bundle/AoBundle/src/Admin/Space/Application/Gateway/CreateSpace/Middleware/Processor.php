<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CreateSpace\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CreateSpace\Request;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CreateSpace\Response;
use Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Identity\SpaceIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private SpaceIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();

        ($this->commandBus)(new Command(
            $identity,
            $request->getCode(),
            $request->getName(),
        ));

        return new Response($identity);
    }
}
