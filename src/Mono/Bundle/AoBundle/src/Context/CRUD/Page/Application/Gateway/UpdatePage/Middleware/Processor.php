<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\UpdatePage\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\UpdatePage\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\UpdatePage\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Write\Update\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new Command(
            $request->getIdentifier(),
            $request->getName(),
            $request->getSlug(),
            $request->getContent(),
            $request->getSpaces(),
        ));

        return new Response();
    }
}
