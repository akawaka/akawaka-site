<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaceByCode\Middleware;

use App\CMS\Application\Space\Gateway\FindSpaceByCode\Request;
use App\CMS\Application\Space\Gateway\FindSpaceByCode\Response;
use App\CMS\Application\Space\Operation\Read\FindByCode\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getCode()));

        return new Response($space);
    }
}
