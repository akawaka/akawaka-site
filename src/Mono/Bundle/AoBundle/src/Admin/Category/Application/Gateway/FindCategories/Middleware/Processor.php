<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategories\Middleware;

use Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategories\Request;
use Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategories\Response;
use Mono\Bundle\AoBundle\Admin\Category\Application\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
