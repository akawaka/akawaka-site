<?php

declare(strict_types=1);

namespace App\Admin\Space\Application\Gateway\UpdateSpace\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\UpdateSpace\Response;
use App\Admin\Space\Application\Operation\Write\Update\Command;
use App\Admin\Space\Application\Gateway\UpdateSpace\Request;
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
            $request->getUrl(),
            $request->getDescription(),
            $request->getTheme(),
        ));

        return new Response();
    }
}
