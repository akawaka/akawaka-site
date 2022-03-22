<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\BrowseCategories\Middleware;

use App\Context\Admin\Category\Application\Gateway\BrowseCategories\Request;
use App\Context\Admin\Category\Application\Gateway\BrowseCategories\Response;
use App\Context\Admin\Category\Application\Operation\Read\Browse\Query;
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
