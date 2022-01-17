<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticles\Middleware;

use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticles\Response;
use Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Read\FindAll\Query;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticles\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
