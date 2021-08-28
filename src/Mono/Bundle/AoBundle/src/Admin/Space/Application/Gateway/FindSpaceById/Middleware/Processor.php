<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceById\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceById\Request;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceById\Response;
use Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Read\FindById\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
