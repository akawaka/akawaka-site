<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\UpdateCategory\Middleware;

use App\Context\Admin\Category\Application\Gateway\UpdateCategory\Request;
use App\Context\Admin\Category\Application\Gateway\UpdateCategory\Response;
use App\Context\Admin\Category\Application\Operation\Write\Update\Command;
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
        ));

        return new Response();
    }
}
