<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\FindSpaces\Middleware;

use App\Context\Admin\Space\Application\Gateway\FindSpaces\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaces\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Read\FindAll\Query;
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
