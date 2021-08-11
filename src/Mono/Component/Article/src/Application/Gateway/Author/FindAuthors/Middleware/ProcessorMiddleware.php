<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\FindAuthors\Middleware;

use Mono\Component\Article\Application\Gateway\Author\FindAuthors\Request;
use Mono\Component\Article\Application\Gateway\Author\FindAuthors\Response;
use Mono\Component\Article\Application\Operation\Author\Read\FindAll\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $authors = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($authors as $author) {
            $response->add($author);
        }

        return $response;
    }
}
