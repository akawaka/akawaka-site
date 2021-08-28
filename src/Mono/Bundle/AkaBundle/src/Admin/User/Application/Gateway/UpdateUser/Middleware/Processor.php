<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdateUser\Middleware;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdateUser\Request;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdateUser\Response;
use Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\Update\Command;
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
            $request->getContent(),
            $request->getCategories(),
            $request->getAuthors(),
            $request->getSpaces(),
        )));
    }
}
