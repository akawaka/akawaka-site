<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\PublishPage\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\PublishPage\Request;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\PublishPage\Response;
use Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Publish\Command;
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
            $request->getIdentifier()
        ));

        return new Response();
    }
}
