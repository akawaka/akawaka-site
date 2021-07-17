<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindArticleById\Middleware;

use Mono\Component\Article\Application\Gateway\Article\FindArticleById\Request;
use App\CMS\Application\Article\Gateway\FindArticleById\Response;
use Mono\Component\Article\Application\Operation\Article\Read\FindById\Query;
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
