<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUserById\Middleware;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUserById\Request;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUserById\Response;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Read\FindById\Query;
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
            new Query($request->getIdentifier())
        ));
    }
}
