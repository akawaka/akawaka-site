<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategoryById\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategoryById\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategoryById\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Read\FindById\Query;
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
            new Query($request->getIdentifier())
        ));
    }
}
