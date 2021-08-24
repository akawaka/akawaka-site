<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\FindCategories\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\FindCategories\Request;
use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\FindCategories\Response;
use Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

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
