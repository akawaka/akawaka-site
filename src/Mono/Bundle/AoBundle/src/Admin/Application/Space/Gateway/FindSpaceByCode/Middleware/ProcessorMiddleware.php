<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaceByCode\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaceByCode\Request;
use Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaceByCode\Response;
use Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Read\FindByCode\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
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
