<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceById\Middleware;

use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceById\Request;
use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceById\Response;
use Mono\Bundle\AoBundle\Application\Space\Operation\Read\FindById\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getIdentifier()));

        return new Response($space);
    }
}
