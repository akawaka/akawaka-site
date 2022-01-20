<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUsers\Middleware;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUsers\Request;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUsers\Response;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $users = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($users->getUsers() as $user) {
            $response->add($user);
        }

        return $response;
    }
}
