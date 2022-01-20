<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\CreateAuthor\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\CreateAuthor\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\CreateAuthor\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Identity\AuthorIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private AuthorIdentityGenerator $identityGenerator,
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
