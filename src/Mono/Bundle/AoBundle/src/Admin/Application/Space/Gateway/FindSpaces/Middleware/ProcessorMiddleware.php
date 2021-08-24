<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaces\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaces\Request;
use Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaces\Response;
use Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

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
