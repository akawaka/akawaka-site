<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Request;
use Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\FindPages\Response;
use Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $pages = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($pages as $page) {
            $response->add($page);
        }

        return $response;
    }
}
