<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\CreateCategory\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\CreateCategory\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\CreateCategory\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Identity\CategoryIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private CategoryIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();
        ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
        ));

        return new Response($identity);
    }
}
