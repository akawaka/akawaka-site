<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorById\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorById\Request;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorById\Response;
use Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Read\FindById\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
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
