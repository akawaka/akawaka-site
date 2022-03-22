<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Gateway\BrowsePages\Middleware;

use App\Context\Admin\Page\Application\Gateway\BrowsePages\Request;
use App\Context\Admin\Page\Application\Gateway\BrowsePages\Response;
use App\Context\Admin\Page\Application\Operation\Read\Browse\Query;
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
