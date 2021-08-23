<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticleBySlug\Middleware;

use Mono\Component\Article\Application\Gateway\Article\FindArticleBySlug\Request;
use Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticleBySlug\Response;
use Mono\Component\Article\Application\Operation\Article\Read\FindBySlug\Query;
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
