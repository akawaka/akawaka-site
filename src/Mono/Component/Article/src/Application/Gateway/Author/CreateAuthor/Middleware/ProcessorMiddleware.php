<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\CreateAuthor\Middleware;

use Mono\Component\Article\Application\Gateway\Author\CreateAuthor\Request;
use Mono\Component\Article\Application\Gateway\Author\CreateAuthor\Response;
use Mono\Component\Article\Application\Operation\Author\Write\Create\Command;
use Mono\Component\Article\Infrastructure\Identity\AuthorIdentityGenerator;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
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
