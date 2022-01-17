<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\UpdateAuthor\Middleware;

use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\UpdateAuthor\Response;
use Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Write\Update\Command;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\UpdateAuthor\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
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
