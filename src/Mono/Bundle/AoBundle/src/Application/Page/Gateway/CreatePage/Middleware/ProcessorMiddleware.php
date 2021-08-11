<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\CreatePage\Middleware;

use Mono\Bundle\AoBundle\Application\Page\Gateway\CreatePage\Request;
use Mono\Component\Page\Application\Gateway\CreatePage\Response;
use Mono\Bundle\AoBundle\Application\Page\Operation\Write\Create\Command;
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
        $command = ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
            $request->getSpaces(),
        ));

        return new Response($identity, $command);
    }
}
