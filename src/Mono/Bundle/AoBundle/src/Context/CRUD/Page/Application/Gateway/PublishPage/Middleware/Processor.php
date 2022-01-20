<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\PublishPage\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\PublishPage\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\PublishPage\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Write\Publish\Command;
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
            $request->getIdentifier()
        ));

        return new Response();
    }
}
