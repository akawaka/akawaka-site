<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\BrowseCategories\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\BrowseCategories\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\BrowseCategories\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Read\Browse\Query;
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
