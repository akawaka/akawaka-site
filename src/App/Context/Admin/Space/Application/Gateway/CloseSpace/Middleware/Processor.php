<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\CloseSpace\Middleware;

use App\Context\Admin\Space\Application\Gateway\CloseSpace\Request;
use App\Context\Admin\Space\Application\Gateway\CloseSpace\Response;
use App\Context\Admin\Space\Application\Operation\Write\Close\Command;
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
