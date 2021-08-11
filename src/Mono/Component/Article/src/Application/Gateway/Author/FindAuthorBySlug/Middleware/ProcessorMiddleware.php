<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\FindAuthorBySlug\Middleware;

use Mono\Component\Article\Application\Gateway\Author\FindAuthorBySlug\Request;
use Mono\Component\Article\Application\Gateway\Author\FindAuthorBySlug\Response;
use Mono\Component\Article\Application\Operation\Author\Read\FindBySlug\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

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
