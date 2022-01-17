<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthorBySlug\Middleware;

use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthorBySlug\Response;
use Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Read\FindBySlug\Query;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthorBySlug\Request;
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
