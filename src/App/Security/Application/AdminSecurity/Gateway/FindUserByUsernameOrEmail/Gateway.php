<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUserByUsernameOrEmail;

use App\Security\Application\AdminSecurity\Operation\Read\FindUserByUsernameOrEmail;
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
            $user = ($this->queryBus)(new FindUserByUsernameOrEmail\Query($request->getUsernameOrEmail()));

            $response = new Response($user);
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find user by username or email process', $exception->getFile(), $exception->getMessage());
        }
    }
}
