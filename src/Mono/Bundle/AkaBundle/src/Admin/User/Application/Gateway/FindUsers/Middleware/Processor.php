<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers\Middleware;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers\Request;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers\Response;
use Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $Users = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($Users as $User) {
            $response->add($User);
        }

        return $response;
    }
}
