<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticles\Middleware;

use Mono\Component\Article\Application\Gateway\Article\FindArticles\Request;
use Mono\Bundle\AoBundle\Application\Article\Gateway\FindArticles\Response;
use Mono\Component\Article\Application\Operation\Article\Read\FindAll\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $articles = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($articles as $article) {
            $response->add($article);
        }

        return $response;
    }
}
