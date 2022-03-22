<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\BrowseSpaces\Middleware;

use App\Context\Admin\Space\Application\Gateway\BrowseSpaces\Response;
use App\Context\Admin\Space\Application\Gateway\BrowseSpaces\Request;
use App\Context\Admin\Space\Application\Operation\Read\Browse\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
