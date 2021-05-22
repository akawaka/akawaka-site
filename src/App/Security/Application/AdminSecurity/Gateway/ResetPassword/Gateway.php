<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\ResetPassword;

use Mono\Component\AdminSecurity\Application\Operation\Read\FindUserByUsernameOrEmail;
use App\Security\Application\AdminSecurity\Operation\Write\ResetPassword;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $user = ($this->queryBus)(new FindUserByUsernameOrEmail\Query($request->getEmail()));

            $response = new Response(($this->commandBus)(new ResetPassword\Command(
                $user,
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during recovery process', $exception->getFile(), $exception->getMessage());
        }
    }
}
