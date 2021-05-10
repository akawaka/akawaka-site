<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindPasswordRecoveryByToken;

use Mono\Component\AdminSecurity\Application\Operation\Read\FindPasswordRecoveryByToken;
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
            $recovery = ($this->queryBus)(new FindPasswordRecoveryByToken\Query($request->getToken()));

            $response = new Response($recovery);
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find user by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
