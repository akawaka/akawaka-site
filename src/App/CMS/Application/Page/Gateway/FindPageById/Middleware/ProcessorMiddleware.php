<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\FindPageById\Middleware;

use Mono\Component\Page\Application\Gateway\FindPageById\Request;
use App\CMS\Application\Page\Gateway\FindPageById\Response;
use Mono\Component\Page\Application\Operation\Read\FindById\Query;
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
            $request->getIdentifier()
        )));
    }
}
