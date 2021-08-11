<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageBySlug\Middleware;

use Mono\Component\Page\Application\Gateway\FindPageBySlug\Request;
use Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageBySlug\Response;
use Mono\Component\Page\Application\Operation\Read\FindBySlug\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->queryBus)(new Query(
            $request->getSlug()
        )));
    }
}
