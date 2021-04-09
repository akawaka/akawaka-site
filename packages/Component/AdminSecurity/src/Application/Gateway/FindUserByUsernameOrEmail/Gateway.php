<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Component\AdminSecurity\Application\Operation\Read\GetByUsernameOrEmail;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $user = ($this->queryBus)(new GetByUsernameOrEmail\Query($request->getUsernameOrEmail()));

            $response = new Response($user);
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find user by username or email process', $exception->getFile(), $exception->getMessage());
        }
    }
}
