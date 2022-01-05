<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById\Middleware;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById\Request;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById\Response;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Operation\Read\FindById;
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
            new FindById\Query($request->getId())
        ));
    }
}
