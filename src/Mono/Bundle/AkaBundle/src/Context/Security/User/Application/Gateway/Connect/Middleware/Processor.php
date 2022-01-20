<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Application\Gateway\Connect\Middleware;

use Mono\Bundle\AkaBundle\Context\Security\User\Application\Gateway\Connect\Request;
use Mono\Bundle\AkaBundle\Context\Security\User\Application\Gateway\Connect\Response;
use Mono\Bundle\AkaBundle\Context\Security\User\Application\Operation\Write\AuthenticateUser\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->queryBus)(
            new Command($request->getUsername())
        ));
    }
}
