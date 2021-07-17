<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\CreateCategory\Middleware;

use Mono\Component\Article\Application\Gateway\Category\CreateCategory\Request;
use Mono\Component\Article\Application\Gateway\Category\CreateCategory\Response;
use Mono\Component\Article\Application\Operation\Category\Write\Create\Command;
use Mono\Component\Article\Infrastructure\Identity\CategoryIdentityGenerator;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private CategoryIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();
        $command = ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
        ));

        return new Response($identity, $command);
    }
}
