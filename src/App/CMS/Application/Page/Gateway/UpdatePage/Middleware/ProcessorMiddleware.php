<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\UpdatePage\Middleware;

use App\CMS\Application\Page\Gateway\UpdatePage\Request;
use App\CMS\Application\Page\Gateway\UpdatePage\Response;
use App\CMS\Application\Page\Operation\Write\Update\Command;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

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
            $request->getContent(),
            $request->getSpaces(),
        )));
    }
}
