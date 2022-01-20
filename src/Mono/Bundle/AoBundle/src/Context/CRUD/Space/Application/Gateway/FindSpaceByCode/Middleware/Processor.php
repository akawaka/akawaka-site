<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceByCode\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceByCode\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceByCode\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Read\FindByCode\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getCode()));

        return new Response($space);
    }
}
