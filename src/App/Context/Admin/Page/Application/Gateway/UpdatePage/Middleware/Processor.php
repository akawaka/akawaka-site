<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Gateway\UpdatePage\Middleware;

use App\Context\Admin\Page\Application\Gateway\UpdatePage\Request;
use App\Context\Admin\Page\Application\Gateway\UpdatePage\Response;
use App\Context\Admin\Page\Application\Operation\Write\Update\Command;
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
