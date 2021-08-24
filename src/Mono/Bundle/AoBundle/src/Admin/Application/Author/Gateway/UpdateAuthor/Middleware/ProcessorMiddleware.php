<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\UpdateAuthor\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\UpdateAuthor\Request;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\UpdateAuthor\Response;
use Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Write\Update\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->commandBus)(new Command(
            $request->getIdentifier(),
            $request->getName(),
            $request->getSlug(),
        )));
    }
}
