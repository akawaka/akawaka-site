<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindUserByUsernameOrEmail\Middleware;

use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindUserByUsernameOrEmail\Request;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindUserByUsernameOrEmail\Response;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Read\FindUserByUsernameOrEmail;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->queryBus)(
            new FindUserByUsernameOrEmail\Query($request->getUsernameOrEmail())
        ));
    }
}
