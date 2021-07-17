<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaces\Middleware;

use App\CMS\Application\Space\Gateway\FindSpaces\Request;
use App\CMS\Application\Space\Gateway\FindSpaces\Response;
use App\CMS\Application\Space\Operation\Read\FindAll\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $spaces = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($spaces as $space) {
            $response->addSpace($space);
        }

        return $response;
    }
}
