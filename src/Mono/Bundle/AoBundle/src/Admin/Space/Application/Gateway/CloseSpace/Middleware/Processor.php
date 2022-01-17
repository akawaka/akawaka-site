<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CloseSpace\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CloseSpace\Response;
use Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Close\Command;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CloseSpace\Request;
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
            $request->getIdentifier()
        )));
    }
}
