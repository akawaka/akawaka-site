<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\DeleteAuthor\Middleware;

use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\DeleteAuthor\Response;
use Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Write\Delete\Command;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\DeleteAuthor\Request;
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
