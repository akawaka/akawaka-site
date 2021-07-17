<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\FindCategories\Middleware;

use Mono\Component\Article\Application\Gateway\Category\FindCategories\Request;
use Mono\Component\Article\Application\Gateway\Category\FindCategories\Response;
use Mono\Component\Article\Application\Operation\Category\Read\FindAll\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $categories = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($categories as $category) {
            $response->add($category);
        }

        return $response;
    }
}
