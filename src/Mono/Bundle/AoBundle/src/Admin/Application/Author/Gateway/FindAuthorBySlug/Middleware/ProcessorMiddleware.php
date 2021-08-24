<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorBySlug\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorBySlug\Request;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorBySlug\Response;
use Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Read\FindBySlug\Query;
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
            new Query($request->getSlug())
        ));
    }
}
