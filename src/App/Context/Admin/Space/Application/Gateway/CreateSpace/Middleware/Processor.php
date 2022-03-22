<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\CreateSpace\Middleware;

use App\Context\Admin\Space\Application\Gateway\CreateSpace\Request;
use App\Context\Admin\Space\Application\Gateway\CreateSpace\Response;
use App\Context\Admin\Space\Application\Operation\Write\Create\Command;
use App\Shared\Infrastructure\Identity\SpaceIdentityGenerator;
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
            $request->getTheme(),
        ));

        return new Response($identity);
    }
}
