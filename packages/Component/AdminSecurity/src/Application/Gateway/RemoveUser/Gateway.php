<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\RemoveUser;

use Mono\Component\AdminSecurity\Application\Operation\Read\GetById;
use Mono\Component\AdminSecurity\Application\Operation\Write\Remove\Command;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $user = ($this->queryBus)(new GetById\Query($request->getIdentifier()));
            $response = new Response(($this->commandBus)(new Command($user)));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during remove user process', $exception->getFile(), $exception->getMessage());
        }
    }
}
