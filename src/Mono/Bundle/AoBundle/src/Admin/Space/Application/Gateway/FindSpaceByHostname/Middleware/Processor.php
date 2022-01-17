<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByHostname\Middleware;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByHostname\Response;
use Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Read\FindByCode\Query;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByHostname\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getHostname()));

        return new Response($space);
    }
}
