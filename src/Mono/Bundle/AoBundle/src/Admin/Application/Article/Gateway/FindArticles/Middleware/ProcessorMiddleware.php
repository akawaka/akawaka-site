<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticles\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticles\Request;
use Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticles\Response;
use Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

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
