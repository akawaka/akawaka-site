<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\FindCategoryById\Middleware;

use Mono\Component\Article\Application\Gateway\Category\FindCategoryById\Request;
use Mono\Component\Article\Application\Gateway\Category\FindCategoryById\Response;
use Mono\Component\Article\Application\Operation\Category\Read\FindById\Query;
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
            new Query($request->getIdentifier())
        ));
    }
}
