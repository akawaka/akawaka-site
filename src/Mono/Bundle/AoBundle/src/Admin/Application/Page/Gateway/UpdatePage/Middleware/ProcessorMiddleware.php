<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\UpdatePage\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\UpdatePage\Request;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\UpdatePage\Response;
use Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Update\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
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
