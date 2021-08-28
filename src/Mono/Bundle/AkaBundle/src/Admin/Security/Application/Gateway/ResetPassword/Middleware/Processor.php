<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Middleware;

use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Request;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\ResetPassword\Response;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Read\FindUserByUsernameOrEmail;
use Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Write\ResetPassword;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $user = ($this->queryBus)(new FindUserByUsernameOrEmail\Query($request->getEmail()));

        return new Response(($this->commandBus)(new ResetPassword\Command(
            $user,
        )));
    }
}
