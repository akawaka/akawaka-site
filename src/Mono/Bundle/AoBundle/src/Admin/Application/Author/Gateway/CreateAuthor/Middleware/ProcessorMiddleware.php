<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\CreateAuthor\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\CreateAuthor\Request;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\CreateAuthor\Response;
use Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Admin\Infrastructure\Identity\AuthorIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

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
