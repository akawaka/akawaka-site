<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticleBySlug\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticleBySlug\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticleBySlug\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Read\FindBySlug\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
