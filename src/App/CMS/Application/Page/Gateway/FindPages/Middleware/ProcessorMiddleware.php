<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\FindPages\Middleware;

use Mono\Component\Page\Application\Gateway\FindPages\Request;
use App\CMS\Application\Page\Gateway\FindPages\Response;
use Mono\Component\Page\Application\Operation\Read\FindAll\Query;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

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
