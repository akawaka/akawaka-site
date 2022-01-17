<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleById\Middleware;

use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleById\Response;
use Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Read\FindById\Query;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleById\Request;
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
            new Query($request->getIdentifier())
        ));
    }
}
