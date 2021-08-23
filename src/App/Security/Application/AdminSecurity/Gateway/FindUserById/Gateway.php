<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUserById;

use App\Security\Application\AdminSecurity\Operation\Read\FindUserById;
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
            $user = ($this->queryBus)(new FindUserById\Query($request->getIdentifier()));

            $response = new Response($user);
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find user by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
