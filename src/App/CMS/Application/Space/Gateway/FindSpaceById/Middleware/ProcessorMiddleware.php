<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaceById\Middleware;

use App\CMS\Application\Space\Gateway\FindSpaceById\Request;
use App\CMS\Application\Space\Gateway\FindSpaceById\Response;
use App\CMS\Application\Space\Operation\Read\FindById\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getIdentifier()));

        return new Response($space);
    }
}
