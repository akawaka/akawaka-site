<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\CreatePage\Middleware;

use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\CreatePage\Request;
use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\CreatePage\Response;
use Mono\Bundle\AoBundle\Admin\Page\Application\Operation\Write\Create\Command;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Identity\PageIdentityGenerator;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private PageIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $identity = $this->identityGenerator->nextIdentity();
        ($this->commandBus)(new Command(
            $identity,
            $request->getName(),
            $request->getSlug(),
            $request->getSpaces(),
        ));

        return new Response($identity);
    }
}
