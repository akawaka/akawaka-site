<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\DeletePage\Middleware;

use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\DeletePage\Request;
use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\DeletePage\Response;
use Mono\Bundle\AoBundle\Admin\Page\Application\Operation\Write\Delete\Command;
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
