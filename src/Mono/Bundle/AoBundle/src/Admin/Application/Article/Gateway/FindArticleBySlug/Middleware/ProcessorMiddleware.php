<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticleBySlug\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticleBySlug\Request;
use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticleBySlug\Response;
use Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Read\FindBySlug\Query;
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
