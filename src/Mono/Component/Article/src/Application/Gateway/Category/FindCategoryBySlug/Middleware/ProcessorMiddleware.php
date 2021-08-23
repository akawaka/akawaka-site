<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\FindCategoryBySlug\Middleware;

use Mono\Component\Article\Application\Gateway\Category\FindCategoryBySlug\Request;
use Mono\Component\Article\Application\Gateway\Category\FindCategoryBySlug\Response;
use Mono\Component\Article\Application\Operation\Category\Read\FindBySlug\Query;
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
