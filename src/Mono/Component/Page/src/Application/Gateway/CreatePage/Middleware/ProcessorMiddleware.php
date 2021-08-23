<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\CreatePage\Middleware;

use Mono\Component\Page\Application\Gateway\CreatePage\Request;
use Mono\Component\Page\Application\Gateway\CreatePage\Response;
use Mono\Component\Page\Application\Operation\Write\Create\Command;
use Mono\Component\Page\Infrastructure\Identity\PageIdentityGenerator;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private PageIdentityGenerator $identityGenerator,
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
