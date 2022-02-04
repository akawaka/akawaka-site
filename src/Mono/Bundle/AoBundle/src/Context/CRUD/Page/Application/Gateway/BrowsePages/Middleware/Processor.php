<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\BrowsePages\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\BrowsePages\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\BrowsePages\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Read\Browse\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
