<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\BrowseArticles\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\BrowseArticles\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\BrowseArticles\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Read\Browse\Query;
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
