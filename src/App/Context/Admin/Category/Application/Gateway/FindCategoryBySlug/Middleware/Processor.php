<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug\Middleware;

use App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug\Request;
use App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug\Response;
use App\Context\Admin\Category\Application\Operation\Read\FindBySlug\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->queryBus)(
            new Query($request->getSlug())
        ));
    }
}
