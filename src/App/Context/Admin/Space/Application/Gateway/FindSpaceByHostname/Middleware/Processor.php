<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname\Middleware;

use App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname\Response;
use App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname\Request;
use App\Context\Admin\Space\Application\Operation\Read\FindByHostname\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $space = ($this->queryBus)(new Query($request->getHostname()));

        return new Response($space);
    }
}
