<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\FindAuthorById\Middleware;

use App\Context\Admin\Author\Application\Gateway\FindAuthorById\Request;
use App\Context\Admin\Author\Application\Gateway\FindAuthorById\Response;
use App\Context\Admin\Author\Application\Operation\Read\FindById\Query;
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
